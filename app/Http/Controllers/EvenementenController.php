<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvenementenToevoegen;

class EvenementenController extends Controller
{
    public function create()
    {
        return view('create_evenement');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titel' => 'nullable|string|max:255',
            'datum' => 'nullable|date',
            'starttijd' => 'nullable|date_format:H:i',
            'eindtijd' => 'nullable|date_format:H:i',
            'beschrijving' => 'nullable|string',
            'locatie' => 'nullable|string|max:255',
            'aantal_beschikbare_plekken' => 'nullable|integer',
            'betaal_link' => 'nullable|string',
            'afbeelding' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' //Max 2MB en juiste extensies
        ]);

        if ($request->hasFile('afbeelding')) {
            $data['afbeelding'] = $request->file('afbeelding')->store('evenementen_fotos', 'public');
        }

        EvenementenToevoegen::create($data);

        return redirect('/index_evenement')->with('success', 'Evenement succesvol toegevoegd!');
    }

    public function index()
    {
        $evenementen = EvenementenToevoegen::all();
        return view('index_evenement', compact('evenementen'));
    }
}

