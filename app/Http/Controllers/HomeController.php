<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $communityNight = App::make(CommunityNightController::class)->latest();
        $eventData = App::make(EvenementenController::class)->latest();

        return view('home', [
            'event' => $eventData['event'],
            'registeredCount' => $eventData['registeredCount'],
            'availableSpots' => $eventData['availableSpots'],
            'communityNight' => $communityNight
        ]);
    }
}
