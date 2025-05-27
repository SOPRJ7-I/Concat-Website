<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ICal\ICal;
use App\Models\Rooster;
use Carbon\Carbon;

class RoostersController extends Controller
{
   public function index()
{
    $roosters = Rooster::latest()->take(10)->get(); // laatste 10 kalenders ophalen
    $events = [];
    $colors = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe'];

    foreach ($roosters as $index => $rooster) {
        $ical = new ICal(null, [
            'defaultSpan'     => 2,
            'defaultTimeZone' => 'Europe/Amsterdam',
        ]);

        try {
            $ical->initUrl($rooster->ical_url);
            $icalEvents = $ical->events();

            foreach ($icalEvents as $event) {
                $start = Carbon::parse($event->dtstart)->setTimezone('Europe/Amsterdam');
                $end = Carbon::parse($event->dtend)->setTimezone('Europe/Amsterdam');
                $events[] = [
                    'title'         => $event->summary,
                    'start'         => $start->format('d-m-Y H:i'),
                    'end'           => $end->format('d-m-Y H:i'),
                    'calendar_name' => substr($rooster->ical_url, -10),
                    'color'         => $colors[$index % count($colors)],
                ];
            }
        } catch (\Exception $e) {
            // Fout bij laden kalender, gewoon skippen
        }
    }

    return view('roosters.index', compact('roosters', 'events', 'colors'));
}




    public function store(Request $request)
    {
        $validated = $request->validate([
            'ical_url' => 'required|url',
        ]);

    // Maak een nieuw record aan ipv updateOrCreate
    Rooster::create([
        'ical_url' => $validated['ical_url'],
    ]);

        return redirect()->back()->with('success', 'Roosterlink opgeslagen!');
    }
    public function destroy(Rooster $rooster)
    {
        try {
            $rooster->delete();
            return redirect()->back()->with('success', 'Rooster verwijderd!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Kon rooster niet verwijderen: ' . $e->getMessage());
        }
    }

}
