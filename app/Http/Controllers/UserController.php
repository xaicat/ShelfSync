<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use App\Models\Contact;
use App\Models\Wishlist;
use App\Models\ReadingProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // § Search sandbox — all books (id, name, author, image)
        $searchableBooks = Book::select('id', 'name', 'author', 'image')->limit(100)->get();

        // § Live Availability feed — available books, newest first
        $availableBooks = Book::where('quantity', '>', 0)
            ->withCount('rentals')
            ->orderByDesc('rentals_count')
            ->limit(12)
            ->get();

        // § Due Back Soon Radar — approved rentals with a due_date in the next 10 days
        $dueSoonRentals = Rental::with('book')
            ->where('approval_status', 'approved')
            ->whereNotNull('due_date')
            ->where('due_date', '>=', now())
            ->where('due_date', '<=', now()->addDays(10))
            ->orderBy('due_date')
            ->limit(6)
            ->get();

        // § Live metrics
        $metrics = [
            'books'    => Book::count(),
            'students' => \App\Models\User::where('role', 'user')->count(),
            'rentals'  => Rental::count(),
            'resolved' => \App\Models\FineAppeal::where('status', 'resolved')->count(),
        ];

        return view('welcome', compact(
            'searchableBooks', 'availableBooks', 'dueSoonRentals', 'metrics'
        ));
    }

    // ── User Dashboard ─────────────────────────────────────────
    public function dashboard()
    {
        $user = Auth::user();

        $activeRentals   = Rental::with('book')->where('user_id', $user->id)->where('approval_status', 'approved')->get();
        $pendingRentals  = Rental::where('user_id', $user->id)->where('approval_status', 'pending')->count();
        $completedBooks  = ReadingProgress::where('user_id', $user->id)->where('status', 'completed')->count();
        $wishlistCount   = Wishlist::where('user_id', $user->id)->count();
        $currentlyReading = ReadingProgress::with('book')->where('user_id', $user->id)->where('status', 'reading')->orderByDesc('updated_at')->get();
        $readingHistory   = ReadingProgress::with('book')->where('user_id', $user->id)->where('status', 'completed')->orderByDesc('completed_at')->limit(5)->get();
        $totalFines       = Rental::where('user_id', $user->id)->sum('fine_amount');

        return view('user.dashboard', compact(
            'user', 'activeRentals', 'pendingRentals',
            'completedBooks', 'wishlistCount',
            'currentlyReading', 'readingHistory', 'totalFines'
        ));
    }

    // ── Reading Tracker ─────────────────────────────────────────
    public function addReading(Request $request)
    {
        $request->validate([
            'book_id'  => 'required|exists:books,id',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        ReadingProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $request->book_id],
            [
                'progress'   => $request->progress ?? 0,
                'status'     => 'reading',
                'started_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Added to your reading list!');
    }

    public function updateProgress(Request $request, $id)
    {
        $rp = ReadingProgress::where('user_id', Auth::id())->findOrFail($id);
        $request->validate(['progress' => 'required|integer|min:0|max:100']);

        $rp->update(['progress' => $request->progress]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'progress' => $rp->progress]);
        }
        return redirect()->back()->with('success', 'Progress updated!');
    }

    public function markRead($id)
    {
        $rp = ReadingProgress::where('user_id', Auth::id())->findOrFail($id);
        $rp->update(['status' => 'completed', 'progress' => 100, 'completed_at' => now()]);
        return redirect()->back()->with('success', 'Book marked as read! 🎉');
    }

    // ── Wishlist ─────────────────────────────────────────────────
    public function toggleWishlist($bookId)
    {
        $existing = Wishlist::where('user_id', Auth::id())->where('book_id', $bookId)->first();
        if ($existing) {
            $existing->delete();
            $state = false;
        } else {
            Wishlist::create(['user_id' => Auth::id(), 'book_id' => $bookId]);
            $state = true;
        }
        return response()->json(['wishlisted' => $state]);
    }

    // ── Books ──────────────────────────────────────────────────
    public function showBooks(Request $request)
    {
        $query = Book::with('category');
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%$q%")
                   ->orWhere('author', 'like', "%$q%")
                   ->orWhere('description', 'like', "%$q%")
                   ->orWhereHas('category', fn($c) => $c->where('name', 'like', "%$q%"));
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $books      = $query->orderBy('name')->get();
        $categories = \App\Models\Category::all();

        // Wishlist IDs for the current user
        $wishlistIds = Auth::check()
            ? Wishlist::where('user_id', Auth::id())->pluck('book_id')->toArray()
            : [];

        return view('user.books', compact('books', 'categories', 'wishlistIds'));
    }

    public function showRentForm($id)
    {
        $book = Book::findOrFail($id);
        return view('user.rent', compact('book'));
    }

    public function processRent(Request $request)
    {
        $request->validate([
            'book_id'        => 'required|exists:books,id',
            'student_number' => 'required|string',
            'return_date'    => 'required|date|after:today',
            'quantity'       => 'required|numeric|min:1',
        ]);

        if (\Illuminate\Support\Facades\Auth::user()->card_status !== 'approved') {
            return redirect()->back()->with('error', 'You must have an approved Library Card to rent books.');
        }

        $book = Book::findOrFail($request->book_id);
        if ($book->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough copies available. Only ' . $book->quantity . ' left.');
        }

        Rental::create([
            'user_id'         => Auth::id(),
            'book_id'         => $book->id,
            'student_id'      => $request->student_number,
            'return_date'     => $request->return_date,
            'quantity'        => $request->quantity,
            'status'          => $request->status ?? 'Online',
            'approval_status' => 'pending',
        ]);

        return redirect()->route('user.my_rents')
            ->with('success', 'Rental request submitted! Awaiting admin approval.');
    }

    public function myRents()
    {
        $rentals = Rental::with('book')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        return view('user.my_rents', compact('rentals'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    // ═══════════════════════════════════════════════
    // LIBRARY CARD SYSTEM
    // ═══════════════════════════════════════════════
    public function applyCard(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'department' => 'required|string'
        ]);

        \App\Models\LibraryCard::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'student_id' => $request->student_id,
                'department' => $request->department,
                'status' => 'pending'
            ]
        );

        return redirect()->back()->with('success', 'Library Card Application submitted.');
    }

    public function renewCard(Request $request)
    {
        $card = Auth::user()->libraryCard;
        if ($card && in_array($card->status, ['expired', 'revoked'])) {
            $card->update(['status' => 'pending']);
        }
        return redirect()->back()->with('success', 'Renewal request submitted.');
    }

    // ═══════════════════════════════════════════════
    // FINE APPEALS
    // ═══════════════════════════════════════════════
    public function submitAppeal(Request $request)
    {
        $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'reason'    => 'required|string|min:10',
        ]);

        \App\Models\FineAppeal::create([
            'rental_id' => $request->rental_id,
            'user_id'   => Auth::id(),
            'reason'    => $request->reason,
            'status'    => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your fine appeal has been submitted to the admin queue.');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'Number'      => 'required|string|max:20',
            'Email'       => 'required|email|max:255',
            'Message'     => 'required|string',
        ]);

        Contact::create([
            'user_id'  => Auth::id(),
            'subject'  => $request->productName,
            'phone'    => $request->Number,
            'email'    => $request->Email,
            'category' => $request->category,
            'message'  => $request->Message,
        ]);

        return redirect()->back()->with('success', 'Your message has been received!');
    }
}