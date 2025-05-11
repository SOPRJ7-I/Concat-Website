<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommunityNightController;
use App\Http\Controllers\SponsorController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementenController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationsController;

// routes/web.php

// Community Nights
Route::resource('community-nights', CommunityNightController::class);

// Sponsors
Route::resource('sponsors', SponsorController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/registration', [RegistrationsController::class, 'store'])->name('registration');

Route::get('/create_evenement', [EvenementenController::class, 'create']);
Route::post('/create_evenement', [EvenementenController::class, 'store']);
Route::get('/index_evenement', [EvenementenController::class, 'index'])->name('index_evenement');
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);
Route::get('/evenementen/{event}', [EvenementenController::class, 'show'])->name('evenementen.show');

//galerij
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register',[AuthController::class, 'Register'])->name('register');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// announcements
Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/load-older', [AnnouncementController::class, 'loadOlder'])->name('announcements.load-older');
