<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // --- DASHBOARD ---
    public function index()
    {
        $bookCount = Book::count();
        $userCount = User::where('role', 'user')->count();
        $categoryCount = Category::count();
        
        return view('admin.dashboard', compact('bookCount', 'userCount', 'categoryCount'));
    }

    // --- CATEGORY MANAGEMENT ---
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

    // --- BOOK MANAGEMENT ---
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
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
        }

        Book::create($data);
        return redirect()->route('admin.books')->with('success', 'Book Added');
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
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required',
        ]);

        $data = $request->except(['_token', '_method', 'productImage']);

        if ($request->hasFile('productImage')) {
            $imageName = time().'.'.$request->productImage->extension();
            $request->productImage->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
        }

        $book->update($data);
        return redirect()->route('admin.books')->with('success', 'Book updated successfully!');
    }

    public function deleteBook($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Book Deleted');
    }

    // --- MEMBER MANAGEMENT ---
    public function members()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.displayMembers', compact('users'));
    }
}