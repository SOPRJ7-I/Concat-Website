<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsletterController extends Controller
{
    // Overzichtspagina
    public function index()
    {
    $newsletters = Newsletter::orderByDesc('publicatiedatum')->paginate(6);

        return view('news.index', compact('newsletters'));
    }

    // Detailpagina van 1 newsletter
    public function show(Newsletter $newsletter)
    {
        return view('newsletters.show', compact('newsletter'));
    }
    // Pagina voor het aanmaken van een nieuwe newsletter
    public function create()
    {
        return view('news.create');
    }
    // Uploaden van een nieuwe newsletter
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'publicatiedatum' => 'required|string',
            'pdf' => 'required|file|mimes:pdf|max:2048',
        ]);
        // Store the PDF in 'storage/app/public/newsletters'
        $pdfPath = $request->file('pdf')->store('newsletters', 'public');
        Newsletter::create([
            'titel' => $validated['titel'],
            'publicatiedatum' => $validated['publicatiedatum'],
            'pdf' => $pdfPath, // Save the file path
        ]);
        return redirect()->route('newsletters.index')->with('success', 'Nieuwsbrief succesvol aangemakt .');
    }
    

}