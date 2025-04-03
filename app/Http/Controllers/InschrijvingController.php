<?php

namespace App\Http\Controllers;

use App\Models\Inschrijving;
use Illuminate\Http\Request;

class InschrijvingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'evenement_id' => 'required|exists:evenementen,id',
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Inschrijving::create([
            'evenement_id' => $request->evenement_id,
            'naam' => $request->naam,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Je bent succesvol ingeschreven!');
    }
}

