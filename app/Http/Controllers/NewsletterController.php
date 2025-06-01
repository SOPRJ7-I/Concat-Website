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

        $published = Newsletter::whereDate('publicatiedatum', '<=', $today)
            ->orderByDesc('publicatiedatum')
            ->paginate(6);

        $upcoming = [];

        if (auth()->check() && auth()->user()->isAdmin()) {
            $upcoming = Newsletter::whereDate('publicatiedatum', '>', $today)
                ->orderBy('publicatiedatum')
                ->get();
        }

        return view('news.index', compact('published', 'upcoming'));
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
        $validated = $request->validate(
            [
                'titel' => 'required|string|max:255|unique:newsletters,titel',
                'publicatiedatum' => 'required|date',
                'inhoud' => 'required|string',
                'images.*' => 'image|max:1000',
            ],
            [
                'titel.required' => 'De titel is verplicht.',
                'publicatiedatum.required' => 'De publicatiedatum is verplicht.',
                'inhoud.required' => 'De inhoud is verplicht.',
                'images.*.image' => 'Alleen afbeeldingen zijn toegestaan.',
                'images.*.max' => 'Elke afbeelding mag maximaal 1MB zijn.',
            ]
        );

        // Afbeeldingen uploaden en paden verzamelen
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('newsletters/images', 'public');
                // Absoluut pad voor DomPDF
                $imagePaths[] = public_path('storage/' . $path);
            }
        }

        // PDF genereren vanuit Blade view
        $pdf = Pdf::loadView('news.pdf', [
            'title' => $validated['titel'],
            'content' => Str::markdown($validated['inhoud']),
            'images' => $imagePaths,
        ]);

        // Unieke bestandsnaam PDF
        $filename = Str::slug($validated['titel']) . '-' . time() . '.pdf';
        $pdfPath = 'newsletters/' . $filename;

        // PDF opslaan
        Storage::disk('public')->put($pdfPath, $pdf->output());

        // Nieuwsbrief aanmaken in database, images als JSON opslaan
        Newsletter::create([
            'titel' => $validated['titel'],
            'publicatiedatum' => $validated['publicatiedatum'],
            'inhoud' => $validated['inhoud'],
            'pdf' => $pdfPath,
            'images' => json_encode($imagePaths),
        ]);

        return redirect()->route('newsletters.index')
            ->with('success', 'Nieuwsbrief succesvol aangemaakt en PDF gegenereerd.');
    }
}
