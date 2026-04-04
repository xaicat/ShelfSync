<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;

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
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'quantity'    => 'required|numeric',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['_token', 'image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
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

        $data = $request->except(['_token', '_method', 'productImage']);

        if ($request->hasFile('productImage')) {
            $imageName = time() . '.' . $request->productImage->extension();
            $request->productImage->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
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
        $users = User::where('role', 'user')->get();
        return view('admin.displayMembers', compact('users'));
    }
}