<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ═══════════════════════════════════════════════
    // DASHBOARD
    // ═══════════════════════════════════════════════
    public function index()
    {
        $bookCount      = Book::count();
        $userCount      = User::where('role', 'user')->count();
        $categoryCount  = Category::count();
        $activeRentals  = Rental::where('approval_status', 'approved')->count();
        $pendingRentals = Rental::where('approval_status', 'pending')->count();
        $overdueRentals = Rental::where('approval_status', 'approved')
                                ->where('return_date', '<', today())
                                ->count();

        return view('admin.dashboard', compact(
            'bookCount', 'userCount', 'categoryCount',
            'activeRentals', 'pendingRentals', 'overdueRentals'
        ));
    }

    // ═══════════════════════════════════════════════
    // RENTAL MANAGEMENT (NEW)
    // ═══════════════════════════════════════════════
    public function rentals(Request $request)
    {
        $query = Rental::with(['user', 'book']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('approval_status', $request->status);
        }

        $rentals = $query
            ->orderByRaw("FIELD(approval_status, 'pending', 'approved', 'returned', 'rejected')")
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('admin.rentals', compact('rentals'));
    }

    public function approveRental($id)
    {
        $rental = Rental::with('book')->findOrFail($id);

        if ($rental->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'This rental is not in a pending state.');
        }
        if ($rental->book->quantity < $rental->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock to approve this rental.');
        }

        $rental->update(['approval_status' => 'approved']);
        $rental->book->decrement('quantity', $rental->quantity); // ← stock decrement on approval

        return redirect()->back()->with('success', 'Rental approved. Stock decremented.');
    }

    public function returnRental($id)
    {
        $rental = Rental::with('book')->findOrFail($id);

        if ($rental->approval_status !== 'approved') {
            return redirect()->back()->with('error', 'Only approved rentals can be marked as returned.');
        }

        $rental->update(['approval_status' => 'returned']);
        $rental->book->increment('quantity', $rental->quantity); // ← THE RESTOCK FIX

        return redirect()->back()->with('success', 'Book returned. Inventory restocked.');
    }

    public function rejectRental($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending rentals can be rejected.');
        }

        $rental->update(['approval_status' => 'rejected']);
        return redirect()->back()->with('success', 'Rental request rejected.');
    }

    // ═══════════════════════════════════════════════
    // QUICK RETURN SCANNER
    // ═══════════════════════════════════════════════
    public function scanReturn()
    {
        return view('admin.returns_scan');
    }

    public function processScan(Request $request)
    {
        $request->validate(['scan_id' => 'required']);
        $scan = trim($request->scan_id);
        
        // Extract numeric ID if scanned QR starts with RENTAL-
        $id = str_replace('RENTAL-', '', strtoupper($scan));
        
        $rental = Rental::find($id);
        if (!$rental) {
            return redirect()->back()->with('error', "No rental record found for '{$scan}'")->withInput();
        }

        if ($rental->approval_status === 'returned') {
            return redirect()->back()->with('error', 'This book has already been returned.');
        }

        if ($rental->approval_status !== 'approved') {
            return redirect()->back()->with('error', 'Cannot return. Rental status is currently: ' . $rental->approval_status);
        }

        // Process Return
        $rental->update(['approval_status' => 'returned']);
        $rental->book->increment('quantity', clone $rental->quantity);

        return redirect()->back()->with('success', "Success! '{$rental->book->name}' has been marked as returned and stock updated.");
    }

    // ═══════════════════════════════════════════════
    // CATEGORY MANAGEMENT
    // ═══════════════════════════════════════════════
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required']);

        if ($request->has('id')) {
            $category = Category::findOrFail($request->id);
            $category->update(['name' => $request->name]);
            return redirect()->back()->with('success', 'Category Updated');
        }

        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category Added');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted');
    }

    // ═══════════════════════════════════════════════
    // BOOK MANAGEMENT
    // ═══════════════════════════════════════════════
    public function books()
    {
        $books = Book::with('category')->get();
        return view('admin.books', compact('books'));
    }

    public function createBook()
    {
        $categories = Category::all();
        return view('admin.books_add', compact('categories'));
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'author'      => 'nullable|string|max:255',
            'category_id' => 'nullable',
            'new_category'=> 'nullable|string|max:255',
            'price'       => 'required|numeric',
            'quantity'    => 'required|numeric',
            'description' => 'nullable',
            'cover_url'   => 'nullable|string|max:2048',
        ]);

        $data = $request->except(['_token', 'image', 'new_category', 'cover_url']);

        // Handle Smart Category Mapping
        if ($request->filled('new_category')) {
            $cat = \App\Models\Category::firstOrCreate(['name' => $request->new_category]);
            $data['category_id'] = $cat->id;
        } elseif (!$request->category_id) {
            return redirect()->back()->withErrors(['category_id' => 'Please select a category or provide a new one.'])->withInput();
        }

        // Handle Image URL directly (No Local Storage)
        if ($request->filled('cover_url')) {
            $data['image'] = $request->cover_url;
        }

        Book::create($data);
        return redirect()->route('admin.books')->with('success', 'Book Added Successfully');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books_update', compact('book', 'categories'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'name'     => 'required',
            'author'   => 'nullable|string|max:255',
            'price'    => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $data = $request->except(['_token', '_method', 'cover_url']);

        if ($request->filled('cover_url')) {
            $data['image'] = $request->cover_url;
        }

        $book->update($data);
        return redirect()->route('admin.books')->with('success', 'Book Updated Successfully');
    }

    public function deleteBook($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Book Deleted');
    }

    // ═══════════════════════════════════════════════
    // MEMBER MANAGEMENT
    // ═══════════════════════════════════════════════
    public function members()
    {
        // Show all users except the currently logged-in admin
        $users = User::where('id', '!=', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('admin.displayMembers', compact('users'));
    }

    public function promoteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }
        $user->update(['role' => 'admin']);
        return redirect()->back()->with('success', "{$user->name} has been promoted to Admin.");
    }

    public function demoteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot demote yourself.');
        }
        $user->update(['role' => 'user']);
        return redirect()->back()->with('success', "{$user->name} has been demoted to User.");
    }

    public function revokeCard($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        \App\Models\LibraryCard::updateOrCreate(
            ['user_id' => $user->id],
            [
                'student_id' => $user->libraryCard->student_id ?? 'REVOKED-' . $user->id,
                'department' => $user->libraryCard->department ?? 'N/A',
                'status' => 'revoked',
                'expires_at' => now()->subDay()
            ]
        );

        return redirect()->back()->with('success', 'Library Access Revoked for ' . $user->name);
    }

    // ═══════════════════════════════════════════════
    // LIBRARY CARD REQUESTS
    // ═══════════════════════════════════════════════
    public function displayCards()
    {
        $cards = \App\Models\LibraryCard::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.cards', compact('cards'));
    }

    public function approveCard($id)
    {
        $card = \App\Models\LibraryCard::findOrFail($id);
        $card->update([
            'status' => 'approved',
            'issued_at' => now(),
            'expires_at' => now()->addMonths(6)
        ]);
        return redirect()->back()->with('success', 'Library Card Approved! Issue Date and 6-Month Expiry configured.');
    }

    public function rejectCard($id)
    {
        $card = \App\Models\LibraryCard::findOrFail($id);
        $card->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Library Card Rejected.');
    }

    // ═══════════════════════════════════════════════
    // FINES & APPEALS
    // ═══════════════════════════════════════════════
    public function fines()
    {
        // Get rentals that either have a fine or an active appeal
        $rentals = \App\Models\Rental::with(['user', 'book', 'fineAppeal'])
            ->where('fine_amount', '>', 0)
            ->orWhereHas('fineAppeal', function($q) {
                $q->where('status', 'pending');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.fines', compact('rentals'));
    }

    public function clearFine($id)
    {
        $rental = \App\Models\Rental::findOrFail($id);
        $rental->update(['fine_amount' => 0]);
        return redirect()->back()->with('success', 'Fine cleared successfully.');
    }

    public function adjustFine(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'action' => 'required|in:add,reduce'
        ]);
        $rental = \App\Models\Rental::findOrFail($id);
        
        if ($request->action === 'add') {
            $rental->update(['fine_amount' => $rental->fine_amount + $request->amount]);
            $msg = 'Fine increased successfully.';
        } else {
            $newAmount = max(0, $rental->fine_amount - $request->amount);
            $rental->update(['fine_amount' => $newAmount]);
            $msg = 'Fine reduced successfully.';
        }
        
        return redirect()->back()->with('success', $msg);
    }

    public function resolveAppeal(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:resolved,rejected']);
        $appeal = \App\Models\FineAppeal::findOrFail($id);
        $appeal->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Appeal ticket ' . $request->status . '.');
    }
}