<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/', function () {
    return redirect('/create_evenement');
});

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index']);
