<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        // Define valid sorting options
        $validSortOrders = ['asc', 'desc'];
        $sortOrder = $request->query('sort', 'asc');
    
        // Validate sorting order
        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'asc';
        }
    
        // Filter out events with missing (null) values
        $evenementen = Evenement::whereNotNull('titel')
                                ->whereNotNull('datum')
                                ->whereNotNull('starttijd')
                                ->whereNotNull('eindtijd')
                                ->whereNotNull('beschrijving')
                                ->whereNotNull('locatie')
                                ->whereNotNull('aantal_beschikbare_plekken')
                                ->whereNotNull('betaal_link')
                                ->whereNotNull('afbeelding')
                                ->orderBy('datum', $sortOrder)
                                ->orderBy('starttijd', $sortOrder)
                                ->paginate(6);
    
        return view('evenementen.index', compact('evenementen', 'sortOrder'));
    }
    
}

