<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        Session::flash('success', 'item created successfully!');
        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png',
        ]);

        $imagePath = $item->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        Session::flash('success', 'item updated successfully!');
    return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        session()->flash('success', 'Ietm deleted successfully!');
    return redirect()->route('items.index');
    }
}
