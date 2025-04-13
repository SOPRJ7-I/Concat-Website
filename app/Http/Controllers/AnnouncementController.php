<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where(function ($query) {
            $query->whereNull('vervaldatum')
                  ->orWhere('vervaldatum', '>', now());
        })->orderByDesc('publicatiedatum')->get();

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'inhoud' => 'required|string',
            'publicatiedatum' => 'required|date',
            'vervaldatum' => 'nullable|date|after_or_equal:publicatiedatum',
        ]);

        Announcement::create($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement toegevoegd.');
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'inhoud' => 'required|string',
            'publicatiedatum' => 'required|date',
            'vervaldatum' => 'nullable|date|after_or_equal:publicatiedatum',
        ]);

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement bijgewerkt.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement verwijderd.');
    }
}
