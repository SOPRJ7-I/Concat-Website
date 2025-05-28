<?php

namespace App\Http\Controllers;

use App\Listeners\Discord\CommunityNights\NewCommunityNightAdded;
use App\Models\CommunityNight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunityNightController extends Controller
{
    public function index()
    {
        return view('community-nights.index', [
           'communityNights' => CommunityNight::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('community-nights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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
            ]);

        $imagePath = null;

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('community-nights', 'public');
        }

        $communityNight = CommunityNight::create([
            'title' => $request->input('title'),
            'image' => $imagePath ? basename($imagePath) : null,
            'description' => $request->input('description'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'location' => $request->input('location'),
            'link' => $request->input('link'),
            'capacity' => $request->input('capacity')
        ]);

        // Gebruik de juiste velden van het model
        event(new NewCommunityNightAdded(
            $communityNight->title,
            $communityNight->description,
            $communityNight->start_time ? date('d-m-Y', strtotime($communityNight->start_time)) : null, // Alleen datum
            $communityNight->start_time ? date('H:i', strtotime($communityNight->start_time)) : null, // Alleen tijd
            $communityNight->location ?? null, // Locatie
            $communityNight->capacity ?? null, // Beschikbare plekken
            route('community-nights.show', $communityNight->id)
        ));
        return redirect()->route('community-nights.index');
    }

    public function show(CommunityNight $communityNight)
    {
        return view('community-nights.detail' , ['communityNight' => $communityNight]);
    }

    public function edit(CommunityNight $communityNight)
    {
        return view('community-nights.edit' , ['communityNight' => $communityNight]);
    }

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

    public function destroy(CommunityNight $communityNight)
    {
        if ($communityNight->image) {
            Storage::delete($communityNight->image);
        }

        $communityNight->delete();

        return redirect()->route('community-nights.index')
        ->with('success', 'Community Avond succesvol verwijderd.');
    }

    public function latest()
    {
        return CommunityNight::orderBy('created_at', 'desc')->first();
    }
}
