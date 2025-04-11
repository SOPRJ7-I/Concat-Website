<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityNightController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;
// routes/web.php


Route::resource('community-nights', CommunityNightController::class);

Route::get('/', function () {
    return redirect('/index_evenement');
});

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index'])->name('index_evenement');
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);
Route::get('/evenementen/{event}', [EvenementenController::class, 'show'])->name('evenementen.show');

Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register',[AuthController::class, 'Register'])->name('register');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
