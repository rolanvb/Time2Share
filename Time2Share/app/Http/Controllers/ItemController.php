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
        // Fetch items without a contract and paginate them
        $items = Item::whereDoesntHave('contracts')->paginate(10);
        return view('dashboard', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('public/images');
            $validatedData['image_url'] = asset(Storage::url($path));
        }

        $item = Item::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'owner_id' => Auth::id(),
            'image_url' => $validatedData['image_url'] ?? 'https://via.placeholder.com/150',
        ]);

        return redirect()->route('items.index')->with('success', 'Item created successfull!.');
    }
}
