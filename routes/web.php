<?php

use App\Http\Controllers\CommunityNightController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;
// routes/web.php


Route::resource('community-nights', CommunityNightController::class);



Route::get('/example', function () {
    return view('example');
});

Route::get('/', function () {
    return redirect('/create_evenement');
});

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index']);
