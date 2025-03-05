<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Zorg ervoor dat je het model importeert

class EventController extends Controller
{
    public function index(Request $request)
{
    // Controleer of de opgegeven sorteerwaarde geldig is
    $validSortOrders = ['asc', 'desc'];
    $sortOrder = in_array($request->query('sort'), $validSortOrders) ? $request->query('sort') : 'asc';

    $events = Event::orderBy('start_date', $sortOrder)->get();
    return view('events.index', compact('events', 'sortOrder'));
}

}
