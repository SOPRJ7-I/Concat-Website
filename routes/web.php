<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('evenement_toevoegen');
});