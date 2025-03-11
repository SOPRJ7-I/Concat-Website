<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenementen; // Import the correct model

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        // Check if the sorting query is valid
        $validSortOrders = ['asc', 'desc'];
        $sortOrder = in_array($request->query('sort'), $validSortOrders) ? $request->query('sort') : 'asc';

        // Paginate events and apply sorting
        $evenementen = Evenementen::orderBy('start_datum', $sortOrder)->paginate(6); // Change the number '6' for the number of items per page

        return view('events.index', compact('evenementen', 'sortOrder'));
    }
}

