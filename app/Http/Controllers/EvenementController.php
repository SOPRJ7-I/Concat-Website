<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;

class EvenementController extends Controller
{
    public function index(Request $request)
    {
        
        // Check if the sorting query is valid
        $validSortOrders = ['asc', 'desc'];
        $sortOrder = $request->query('sort', 'asc');
        // Controleren of de opgegeven sorteerwaarde geldig is
        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'asc';
        }
        // Paginate events and apply sorting
        $evenementen = Evenement::orderBy('datum', $sortOrder)
                                ->orderBy('starttijd', $sortOrder)
                                ->paginate(6); // Aantal items per pagina
        return view('evenementen.index', compact('evenementen', 'sortOrder'));
    }
}

