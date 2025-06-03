<?php

namespace App\Http\Controllers;

use App\Listeners\Discord\Events\NewEventAdded;
use Illuminate\Http\Request;
use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    public function create()
    {
        return view('/events/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titel' => 'required|string|max:255',
            'categorie' => 'required|in:blokborrel,education',
            'datum' => 'required|date',
            'einddatum' => 'required|date',
            'starttijd' => 'required|date_format:H:i',
            'eindtijd' => 'required|date_format:H:i',
            'beschrijving' => 'required|string',
            'locatie' => 'required|string|max:255',
            'aantal_beschikbare_plekken' => 'nullable|integer',
            'betaal_link' => 'nullable|string',
            'afbeelding' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' //Max 2MB en juiste extensies
        ],
        [
            'titel.required' => 'Titel is verplicht.',
            'categorie.required' => 'Categorie is verplicht.',
            'datum.required' => 'Datum is verplicht.',
            'einddatum.required' => 'Einddatum is verplicht.',
            'starttijd.required' => 'Starttijd is verplicht.',
            'eindtijd.required' => 'Eindtijd is verplicht.',
            'beschrijving.required' => 'Beschrijving is verplicht.',
            'locatie.required' => 'Locatie is verplicht.',
            'aantal_beschikbare_plekken.integer' => 'Aantal beschikbare plekken moet een getal zijn.',
            'betaal_link.string' => 'Betaal link moet een geldige URL zijn.',
            'afbeelding.image' => 'Afbeelding moet een geldig afbeeldingsbestand zijn.',
            'afbeelding.mimes' => 'Afbeelding moet een van de volgende extensies hebben: jpeg, png, jpg, gif.',
            'afbeelding.max' => 'Afbeelding mag maximaal 2MB groot zijn.',
        ]
    );

        if ($request->hasFile('afbeelding')) {
            $data['afbeelding'] = $request->file('afbeelding')->store('event_images', 'public');
        }

        $event = Events::create($data);

        // Dispatch het event
        event(new NewEventAdded(
            $event->titel,
            $event->beschrijving,
            $event->datum,
            $event->starttijd,
            $event->locatie,
            $event->aantal_beschikbare_plekken,
            route('events.show', $event->id) // Gebruik de show route voor de URL
        ));


        return redirect('/events/index')->with('success', 'Event succesvol toegevoegd!');
    }

    public function index(Request $request)
    {
        $validSortOrders = ['asc', 'desc'];
        $sortOrder = $request->query('sort', 'asc');
        $categorieFilter = $request->query('categorie', 'all');

        $isAfgelopen = $request->query('afgelopen') === 'true';



        $onlyMyEvents = $request->query('myevents', false);

        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'asc';
        }

        $query = Events::whereNotNull('titel')->where('titel', '!=', '')
            ->whereNotNull('datum')
            ->whereNotNull('einddatum')
            ->whereNotNull('starttijd')
            ->whereNotNull('eindtijd')
            ->whereNotNull('beschrijving')->where('beschrijving', '!=', '')
            ->whereNotNull('locatie')->where('locatie', '!=', '');

        if (in_array($categorieFilter, ['blokborrel', 'education'])) {
            $query->where('categorie', $categorieFilter);
        }


        if ($isAfgelopen) {
            $query->whereDate('einddatum', '<', Carbon::today());

        }else {
            $query->whereDate('einddatum', '>=', Carbon::today());
        }

        if ($onlyMyEvents && auth()->check()) {
            $query->whereHas('registrations', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }
        $events = $query->orderBy('datum', $sortOrder)
            ->orderBy('starttijd', $sortOrder)
            ->paginate(6);

        return view('events/index', compact('events', 'sortOrder', 'categorieFilter', 'onlyMyEvents'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Events $event)
    {
    // Get the number of registrations for the event
    $registeredCount = $event->registrations()->count();

    // Get the total available spots (if you have this in the database)
    $availableSpots = $event->aantal_beschikbare_plekken;

    // If available spots are not set, use a default value (e.g., 0)
    if (is_null($availableSpots)) {
        $availableSpots = 0;
    }

    return view('events.detail', [
        'event' => $event,
        'registeredCount' => $registeredCount,
        'availableSpots' => $availableSpots
    ]);

    }

    /**
     * Get the latest event.
     */
    public function latest()
    {
        $event = Events::orderBy('created_at', 'desc')->first();

        if (!$event) {
            return [
                'event' => null,
                'registeredCount' => 0,
                'availableSpots' => 0
            ];
        }

        $registeredCount = $event->registrations()->count();
        $availableSpots = $event->aantal_beschikbare_plekken ?? 0;

        return [
            'event' => $event,
            'registeredCount' => $registeredCount,
            'availableSpots' => $availableSpots
        ];
    }
   public function downloadIcs(Events $event)
{

    $startDateTime = Carbon::parse($event->datum . ' ' . $event->starttijd);
    $endDateTime = Carbon::parse($event->einddatum . ' ' . $event->eindtijd);
    $dtstamp = optional($event->created_at)->format('Ymd\THis\Z') ?? now()->format('Ymd\THis\Z');

    // Escape function to sanitize ICS text fields
    function escapeIcsText($text) {
        return addcslashes($text, ",;\\\n\r");
    }

    $summary = escapeIcsText($event->titel ?? '');
    $description = escapeIcsText($event->beschrijving ?? '');
    $location = escapeIcsText($event->locatie ?? '');

    $content = <<<ICS
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//YourApp//Rooster Calendar//NL
BEGIN:VEVENT
UID:{$event->id}@yourapp.com
DTSTAMP:$dtstamp
DTSTART:{$startDateTime->format('Ymd\THis')}
DTEND:{$endDateTime->format('Ymd\THis')}
SUMMARY:{$summary}
DESCRIPTION:{$description}
LOCATION:{$location}
END:VEVENT
END:VCALENDAR
ICS;

    return response($content, 200, [
        'Content-Type' => 'text/calendar; charset=utf-8',
        'Content-Disposition' => 'attachment; filename="evenement-'. $event->id .'.ics"',
    ]);
}



}

