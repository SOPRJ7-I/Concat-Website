<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvenementenToevoegen;

class EvenementToevoegenController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'string|max:255',
            'datum' => 'required|date',
            'tijd' => 'required',
            'beschrijving' => 'nullable|string',
            'locatie' => 'string',
            'plekken' => 'nullable|integer',
            'betaal_link' => 'nullable|url',
            'categorie' => 'required|string',
        ]);

        EvenementenToevoegen::create($validated);

        return redirect()->back()->with('success', 'Evenement toegevoegd!');
    }
}
