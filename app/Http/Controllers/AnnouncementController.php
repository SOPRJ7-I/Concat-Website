<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('isVisible', true)
            ->orderByDesc('publicatiedatum')
            ->get();

        $groupedAnnouncements = $this->groupAnnouncements($announcements);

        return view('announcements.index', [
            'groupedAnnouncements' => $groupedAnnouncements
        ]);
    }

    private function groupAnnouncements($announcements)
    {
        $grouped = [];
        foreach($announcements as $announcement) {
            $group = $this->getDateGroup($announcement->publicatiedatum);
            $grouped[$group][] = $announcement;
        }
        return $grouped;
    }

    private function getDateGroup($date)
    {
        $now = now();
        $date = $date->copy()->startOfDay();
        $diffInDays = $date->diffInDays($now);

        if($date->isToday()) return 'Vandaag';
        if($date->isYesterday()) return 'Gisteren';
        if($diffInDays <= 7) return 'Deze Week';
        if($diffInDays <= 14) return 'Vorige Week';
        if($date->month == $now->month && $date->year == $now->year) return 'Deze Maand';
        if($date->month == $now->subMonth()->month && $date->year == $now->year) return 'Vorige Maand';

        return $date->translatedFormat('F Y');
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
            'isVisible' => 'required|boolean', // Add this line
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
            'isVisible' => 'required|boolean',
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
