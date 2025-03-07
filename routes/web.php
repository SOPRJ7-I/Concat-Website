<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementToevoegenController;

Route::get('/', function () {
    return view('evenement_toevoegen');
});

Route::post('/evenement_toevoegen', function(){
    return view('show_evenement');
});

Route::view('/show_evenement', 'show_evenement')->name('show_evenement');

