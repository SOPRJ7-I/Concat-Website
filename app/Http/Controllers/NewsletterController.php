<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class NewsletterController extends Controller
{
    // Overzichtspagina
    public function index()
    {
        $today = Carbon::today();
        $newsletters = Newsletter::whereDate('publicatiedatum', '<=', $today)
            ->orderByDesc('publicatiedatum')
            ->paginate(6);

        return view('news.index', compact('newsletters'));
    }

    // Detailpagina van 1 newsletter (optioneel)
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
            'titel' => 'required|string|max:255|unique:newsletters,titel',
            'publicatiedatum' => 'required|date',
            'inhoud' => 'required|string',
        ]);

        // PDF genereren vanuit Blade-view 'news.pdf'
        $pdf = Pdf::loadView('news.pdf', [
            'title' => $validated['titel'],
            'content' => $validated['inhoud'],
        ]);

        // Unieke bestandsnaam maken (slug + timestamp)
        $filename = Str::slug($validated['titel']) . '-' . time() . '.pdf';

        // Opslaan in 'public/newsletters'
        $pdfPath = 'newsletters/' . $filename;
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Nieuwe nieuwsbrief opslaan met PDF-pad
        Newsletter::create([
            'titel' => $validated['titel'],
            'publicatiedatum' => $validated['publicatiedatum'],
            'inhoud' => $validated['inhoud'],
            'pdf' => $pdfPath,
        ]);

        return redirect()->route('newsletters.index')
            ->with('success', 'Nieuwsbrief succesvol aangemaakt en PDF gegenereerd.');
    }
}
