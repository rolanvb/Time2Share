<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        // Fetch items without a contract, eager load the owner relationship, and paginate them
        $items = Item::whereDoesntHave('contracts')->with('owner')->paginate(25);
        return view('dashboard', compact('items'));
    }

    public function pendingRequests()
    {
        // Fetch items with a pending contract, eager load the owner relationship, and paginate them
        $items = Item::whereHas('contracts', function ($query) {
            $query->where('is_accepted', false);
        })->with('owner')->paginate(25);

        return view('pendingRequests', compact('items'));
    }

    public function ownerItems()
    {
        // Fetch items owned by the authenticated user, eager load the owner relationship, and paginate them
        $items = Item::where('owner_id', Auth::id())->with('owner')->paginate(25);
        return view('ownItems', compact('items'));
    }

    public function borrowedItems()
    {
        // Fetch items borrowed by the authenticated user, eager load the owner relationship, and paginate them
        $items = Item::whereHas('contracts', function ($query) {
            $query->where('borrower_id', Auth::id());
        })->with('owner')->paginate(25);
        return view('borrowedItems', compact('items'));
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048',
        ]);

        $validatedData = $request->only(['name', 'description']);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/images');
            $validatedData['image_url'] = asset(Storage::url($path));
        }

        $validatedData['owner_id'] = Auth::id();
        $item = Item::create($validatedData);


        return redirect()->route('items.index')->with('success', 'Item created successfull!.');
    }

    public function show(Item $item)
    {
        // Eager load the owner relationship
        $item->load('owner');

        return view('items.show', compact('item'));
    }
}
