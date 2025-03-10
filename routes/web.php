<?php

use Illuminate\Support\Facades\Route;
use App\Models\EvenementenToevoegen;
use Illuminate\Http\Request;

// Route naar de create-pagina
Route::get('/', function () {
    return view('create_evenement');
});

// Route om het formulier te verwerken en data op te slaan in de database
Route::post('/create_evenement', function (Request $request) {
    EvenementenToevoegen::create($request->all());
    return redirect('/index_evenement');
});

// Route naar de indexpagina waar evenementen getoond worden
Route::get('/index_evenement', function () {
    $evenementen = EvenementenToevoegen::all();
    return view('index_evenement', compact('evenementen'));
});
