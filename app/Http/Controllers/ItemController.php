<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get items created by the logged-in user
        $items = Item::where('user_id', Auth::id())->get();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // 2. Create the item & link to user
        Item::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(), // crucial!
        ]);

        // 3. Redirect back with a success message
        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Ensure the user owns this item before deleting
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted.');
    }
}