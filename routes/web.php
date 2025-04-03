<?php

use App\Http\Controllers\CommunityNightController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;
use App\Http\Controllers\InschrijvingController;

// routes/web.php


Route::resource('community-nights', CommunityNightController::class);

Route::get('/', function () {
    return redirect('/index_evenement');
});
Route::post('/inschrijven', [InschrijvingController::class, 'store'])->name('inschrijven');

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index']);
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);
Route::get('/evenementen/{event}', [EvenementenController::class, 'show'])->name('evenementen.show');
