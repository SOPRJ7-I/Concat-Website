<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvenementenToevoegen;

class EvenementenController extends Controller
{
    // 🔹 Methode om het formulier te tonen
    public function create()
    {
        return view('create_evenement');
    }

    // 🔹 Methode om evenement op te slaan
    public function store(Request $request)
    {
        $data = $request->validate([
            'titel' => 'required|string|max:255',
            'datum' => 'required|date',
            'starttijd' => 'nullable|date_format:H:i',
            'eindtijd' => 'nullable|date_format:H:i',
            'beschrijving' => 'nullable|string',
            'locatie' => 'required|string|max:255',
            'aantal_beschikbare_plekken' => 'nullable|integer',
            'betaal_link' => 'nullable|string',
            'categorie' => 'required|string',
            'afbeelding' => 'nullable|image|max:2048' // Max 2MB afbeelding
        ]);

        // Als er een bestand is geüpload, sla het op
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('evenementen_fotos', 'public');
        }

        // Evenement opslaan in de database
        EvenementenToevoegen::create($data);

        return redirect('/index_evenement')->with('success', 'Evenement toegevoegd!');
    }

    // 🔹 Methode om alle evenementen op te halen en weer te geven
    public function index()
    {
        $evenementen = EvenementenToevoegen::all();
        return view('index_evenement', compact('evenementen'));
    }
}

