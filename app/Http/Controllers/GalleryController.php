<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $request)
{
    $query = Gallery::query();

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $photos = $query->get();

    return view('gallery.gallery', compact('photos'));
}

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:blokborrel,education',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'date' => $request->date,
            'type' => $request->type,
            'src' => 'storage/' . $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto toegevoegd');
    }
}
