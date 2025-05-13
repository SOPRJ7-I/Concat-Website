<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Zichtbare announcements voor iedereen
        $visibleAnnouncements = Announcement::where('isVisible', true)
            ->orderByDesc('published_at')
            ->get();

        $groupedVisible = $this->groupAnnouncements($visibleAnnouncements);

        // Niet-zichtbare alleen voor admins
        $groupedNonVisible = [];
        if(auth()->user() && auth()->user()->isAdmin()) {
            $nonVisibleAnnouncements = Announcement::where('isVisible', false)
                ->orderByDesc('published_at')
                ->get();
            $groupedNonVisible = $this->groupAnnouncements($nonVisibleAnnouncements);
        }

        return view('announcements.index', [
            'groupedVisible' => $groupedVisible,
            'groupedNonVisible' => $groupedNonVisible,
            'showAdminControls' => auth()->user() && auth()->user()->isAdmin()
        ]);
    }
    private function groupAnnouncements($announcements)
    {
        $grouped = [];
        foreach($announcements as $announcement) {
            $group = $this->getDateGroup($announcement->published_at);
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
            'isVisible' => 'required|boolean',
        ]);

        $announcement = Announcement::create($validated);

        // Automatisch published_at instellen bij aanmaken
        if ($announcement->isVisible) {
            $announcement->update(['published_at' => now()]);
        }

        return redirect()->route('announcements.index');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'inhoud' => 'required|string',
            'isVisible' => 'required|boolean',
        ]);

        $announcement->update($validated);

        return redirect()->route('announcements.index');
    }
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement verwijderd.');
    }
}
