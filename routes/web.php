<?php

use App\Http\Controllers\CommunityNightController;
use App\Models\CommunityNight;
use Illuminate\Support\Facades\Route;

//Route::get('/community-nights/{id}', [CommunityNightController::class, 'show']);

Route::resource('community-nights', CommunityNightController::class);
