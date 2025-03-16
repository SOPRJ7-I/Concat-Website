<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;
// routes/web.php



Route::get('/example', function () {
    return view('example');
});

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index']);
