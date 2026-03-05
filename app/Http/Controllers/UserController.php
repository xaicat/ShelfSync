<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the User Home Page (Index)
     */
    public function index()
    {
        $bookCount = Book::sum('quantity');
        return view('user.index', compact('bookCount'));
    }

    /**
     * Display the List of Available Books for Users
     */
    public function showBooks()
    {
        $books = Book::with('category')->get();
        return view('user.books', compact('books'));
    }

    /**
     * Show the Rental Form for a specific book
     */
    public function showRentForm($id)
    {
        $book = Book::findOrFail($id);
        return view('user.rent', compact('book'));
    }

    /**
     * Process the Book Rental Transaction
     */
    public function processRent(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'student_number' => 'required|string',
            'return_date' => 'required|date|after:today',
            'quantity' => 'required|numeric|min:1',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough copies available in the library.');
        }

        Rental::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'student_id' => $request->student_number,
            'return_date' => $request->return_date,
            'quantity' => $request->quantity,
            'status' => $request->status ?? 'Online',
        ]);

        $book->decrement('quantity', $request->quantity);

        return redirect()->route('user.books')->with('success', 'Rental request submitted successfully!');
    }

    /**
     * Show the Contact Us page
     */
    public function contact()
    {
        return view('user.contact');
    }

    /**
     * Handle the Contact Form Submission
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'Number' => 'required|string|max:15',
            'Email' => 'required|email|max:255',
            'Message' => 'required|string',
        ]);

        return redirect()->back()->with('success', 'Your message has been sent to the Admin!');
    }

    /**
     * Display the authenticated user's rented books (NEW)
     */
    public function myRents()
    {
        // Fetch rentals for the logged-in user with associated book data
        $rentals = Rental::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.my_rents', compact('rentals'));
    }
}