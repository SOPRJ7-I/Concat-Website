<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('create_evenement');
});

Route::post('/create_evenement', function(){
    return view('index_evenement');
});

Route::view('/index_evenement', 'index_evenement')->name('index_evenement');
