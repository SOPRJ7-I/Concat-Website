<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementToevoegenController;

Route::get('/', function () {
    return view('evenement_toevoegen');
});

Route::post('/evenement_toevoegen', [EvenementToevoegenController::class, 'store'])->name('evenement.store');