<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'evenement_id' => 'required|exists:evenementen,id',
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:registrations,email,NULL,id,evenement_id,' . $request->evenement_id,
        ]);

        registration::create([
            'evenement_id' => $request->evenement_id,
            'naam' => $request->naam,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Je bent succesvol ingeschreven!');
    }
}

