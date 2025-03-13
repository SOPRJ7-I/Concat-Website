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

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityNight $communityNight)
    {
        return view('community-nights.detail' , ['communityNight' => $communityNight,]);
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
