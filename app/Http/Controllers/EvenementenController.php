<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenementen;

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
        ]);

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

        $evenementen = $query->orderBy('datum', $sortOrder)
            ->orderBy('starttijd', $sortOrder)
            ->paginate(6);

        return view('index_evenement', compact('evenementen', 'sortOrder', 'categorieFilter'));
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

    /**
     * Get the latest event.
     */
    public function latest()
    {
        $event = Evenementen::latest()->first();

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

}

