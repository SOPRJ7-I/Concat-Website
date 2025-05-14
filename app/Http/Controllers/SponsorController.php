<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('sponsors.index', [
            'sponsors' => $sponsors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Sponsor::class);
        return view('sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Sponsor::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image', 'max:10240'],
        ], [
            'name.required' => 'Naam is verplicht.',
            'name.string' => 'Naam moet een string zijn.',
            'name.max' => 'Naam mag niet langer zijn dan 255 tekens.',
            'logo.required' => 'Logo is verplicht.',
            'logo.image' => 'Logo moet een afbeelding zijn.',
            'logo.max' => 'Logo mag niet groter zijn dan 10MB.',
        ]);

        $imagePath = $request->file('logo')->store('sponsor_logos', 'public');

        Sponsor::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'url' => $request['url'],
            'image_path' => $imagePath
        ]);

        return redirect()->route('sponsors.index');
    }

    /**
     * Display the specified resource.
     */
//    public function show(Sponsor $sponsor)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        $this->authorize('update', $sponsor);

        return view('sponsors.edit', [
            'sponsor' => $sponsor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $this->authorize('update', $sponsor);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['image', 'max:10240'],
        ], [
            'name.required' => 'Naam is verplicht.',
            'name.string' => 'Naam moet een string zijn.',
            'name.max' => 'Naam mag niet langer zijn dan 255 tekens.',
            'logo.image' => 'Logo moet een afbeelding zijn.',
            'logo.max' => 'Logo mag niet groter zijn dan 10MB.',
        ]);

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('sponsor_logos', 'public');
        }

        $sponsor->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'url' => $request['url'],
            'image_path' => $imagePath ?? $sponsor->image_path
        ]);

        return redirect()->route('sponsors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        $this->authorize('delete', $sponsor);

        Storage::disk('public')->delete($sponsor->image_path);

        $sponsor->delete();

        return redirect()->route('sponsors.index');
    }
}
