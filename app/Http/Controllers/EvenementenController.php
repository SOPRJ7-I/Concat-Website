<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenementen;
use Carbon\Carbon;

class EvenementenController extends Controller
{
    public function create()
    {
        return view('create_evenement');
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
            $data['afbeelding'] = $request->file('afbeelding')->store('evenementen_fotos', 'public');
        }

        Evenementen::create($data);

        return redirect('/index_evenement')->with('success', 'Evenement succesvol toegevoegd!');
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

        $query = Evenementen::whereNotNull('titel')->where('titel', '!=', '')
            ->whereNotNull('datum')
            ->whereNotNull('einddatum')
            ->whereNotNull('starttijd')
            ->whereNotNull('eindtijd')
            ->whereNotNull('beschrijving')->where('beschrijving', '!=', '')
            ->whereNotNull('locatie')->where('locatie', '!=', '')
            ->whereNotNull('aantal_beschikbare_plekken')
            ->whereNotNull('betaal_link')
            ->where(function ($query) {
                $query->whereNotNull('afbeelding')
                    ->orWhere('afbeelding', '!=', '');
            });

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
        $evenementen = $query->orderBy('datum', $sortOrder)
            ->orderBy('starttijd', $sortOrder)
            ->paginate(6);
    
        return view('index_evenement', compact('evenementen', 'sortOrder', 'categorieFilter', 'onlyMyEvents'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Evenementen $event)
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

    
}

