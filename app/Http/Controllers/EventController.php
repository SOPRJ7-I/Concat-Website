<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Zorg ervoor dat je het model importeert

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Haal alle evenementen op
        return view('events.index', compact('events'));
    }
}
