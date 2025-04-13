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
            'datum' => 'required|date',
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
        // Check if the sorting query is valid
        $validSortOrders = ['asc', 'desc'];
        $sortOrder = $request->query('sort', 'asc');

        
    // Validate sorting order
    if (!in_array($sortOrder, $validSortOrders)) {
        $sortOrder = 'asc';
    }
    // Filter out events with missing (null) values
    $evenementen = Evenementen::whereNotNull('titel')->where('titel', '!=', '')
    ->whereNotNull('datum')
    ->whereNotNull('einddatum')
    ->whereNotNull('starttijd')
    ->whereNotNull('eindtijd')
    ->whereNotNull('beschrijving')->where('beschrijving', '!=', '')
    ->whereNotNull('locatie')->where('locatie', '!=', '')
    ->whereNotNull('aantal_beschikbare_plekken')
    ->whereNotNull('betaal_link')
    ->where(function($query) {
        $query->whereNotNull('afbeelding')
              ->orWhere('afbeelding', '!=', ''); // Allow empty strings
    })    ->orderBy('datum', $sortOrder)
    ->orderBy('starttijd', $sortOrder)
    ->paginate(6);

    return view('index_evenement', compact('evenementen', 'sortOrder'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenementen $event)
    {
        return view('events.detail' , ['event' => $event]);
    }
}

