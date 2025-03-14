<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;

Route::get('/', function () {
    return redirect('/create_evenement'); // 🔹 Dit stuurt de startpagina door
});
use App\Http\Controllers\EvenementController;

Route::get('/evenementen', [EvenementController::class, 'index']);

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index']);