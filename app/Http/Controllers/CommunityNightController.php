<?php

namespace App\Http\Controllers;

use App\Models\CommunityNight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunityNightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('community-nights.index', [
           'communityNights' => CommunityNight::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('community-nights.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $communityNight)
    {
        $communityNight->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required'
        ],
        [
            'title.required' => 'Titel is verplicht.',
            'description.required' => 'Beschrijving is verplicht.',
            'description.min' => 'Beschrijving moet minimaal 10 tekens bevatten.',
            'start_time.required' => 'Starttijd is verplicht.',
            'end_time.required' => 'Eindtijd is verplicht.',
            'location.required' => 'Locatie is verplicht.',
        ]

        );

        $imagePath = null;

        if($communityNight->hasFile('image')){
            $imagePath = $communityNight->file('image')->store('community-nights', 'public');
        }

        CommunityNight::create([
            'title' => $communityNight->input('title'),
            'image' => $imagePath ? basename($imagePath) : null,
            'description' => $communityNight->input('description'),
            'start_time' => $communityNight->input('start_time'),
            'end_time' => $communityNight->input('end_time'),
            'location' => $communityNight->input('location'),
            'link' => $communityNight->input('link'),
            'capacity' => $communityNight->input('capacity')
        ]);

        return redirect()->route('community-nights.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityNight $communityNight)
    {
        return view('community-nights.detail' , ['communityNight' => $communityNight]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityNight $communityNight)
    {
        return view('community-nights.edit' , ['communityNight' => $communityNight]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityNight $communityNight)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'link'=> 'nullable',
            'capacity' => 'nullable|integer|min:0',

        ],
        [
            'title.required' => 'Titel is verplicht.',
            'description.required' => 'Beschrijving is verplicht.',
            'description.min' => 'Beschrijving moet minimaal 10 tekens bevatten.',
            'start_time.required' => 'Starttijd is verplicht.',
            'end_time.required' => 'Eindtijd is verplicht.',
            'location.required' => 'Locatie is verplicht.',
        ]);


        $communityNight->title = $validated['title'];
        $communityNight->description = $validated['description'];
        $communityNight->start_time = $validated['start_time'];
        $communityNight->end_time = $validated['end_time'];
        $communityNight->location = $validated['location'];
        $communityNight->link = $validated['link'] ?? null;
        $communityNight->capacity = $validated['capacity'] ?? null;

        if ($request->hasFile('image')) {

            if ($communityNight->image) {
                Storage::delete($communityNight->image);
            }

            $imagePath = $request->file('image')->store('community-nights', 'public');

            $communityNight->image = $imagePath;
            }

            $communityNight->save();

            // Redirect naar de detailpagina of een andere gewenste pagina
            return redirect()->route('community-nights.edit', $communityNight->id)
                     ->with('success', 'Community avond succesvol bijgewerkt!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityNight $communityNight)
    {
        if ($communityNight->image) {
            Storage::delete($communityNight->image);
        }

        $communityNight->delete();

        return redirect()->route('community-nights.index')
        ->with('success', 'Community Avond succesvol verwijderd.');
    }

    /**
     * Get the latest community night.
     */
    public function latest()
    {
        return CommunityNight::orderBy('created_at', 'desc')->first();
    }
}
