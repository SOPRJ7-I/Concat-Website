<?php

namespace App\Http\Controllers;

use App\Models\CommunityNight;
use Illuminate\Http\Request;

class CommunityNightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('community-nights.index', [
           'communityNights' => CommunityNight::paginate(10)
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
        ]);

        $imagePath = null;

        if($communityNight->hasFile('image')){
            $imagePath = $communityNight->file('image')->store('community_images', 'public');
        }

        CommunityNight::create([
            'title' => $communityNight->input('title'),
            'image' => $imagePath,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityNight $communityNight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityNight $communityNight)
    {
        //
    }
}
