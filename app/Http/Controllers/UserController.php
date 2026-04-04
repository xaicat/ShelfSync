<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

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

        $books = $query->orderBy('name')->get();
        $categories = \App\Models\Category::all();

        return view('user.books', compact('books', 'categories'));
    }

    public function showRentForm($id)
    {
        $book = Book::findOrFail($id);
        return view('user.rent', compact('book'));
    }

    /**
     * Process Rental — creates a PENDING record only.
     * Book quantity is NOT decremented until admin approves.
     */
    public function processRent(Request $request)
    {
        $request->validate([
            'book_id'        => 'required|exists:books,id',
            'student_number' => 'required|string',
            'return_date'    => 'required|date|after:today',
            'quantity'       => 'required|numeric|min:1',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Check availability for optimistic validation only
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
            'approval_status' => 'pending', // ← awaits admin approval
        ]);

        // NOTE: Book quantity is NOT decremented here.
        // It is decremented only when admin approves via approveRental().

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

    /**
     * Contact form — now actually saves to contacts table.
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'Number'      => 'required|string|max:20',
            'Email'       => 'required|email|max:255',
            'category'    => 'nullable|string|max:100',
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

        return redirect()->back()->with('success', 'Your message has been received! We will get back to you shortly.');
    }
}