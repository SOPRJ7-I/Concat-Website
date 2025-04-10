<?php

use App\Http\Controllers\AnnouncementController;
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
Route::get('/index_evenement', [EvenementenController::class, 'index']);
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);
Route::get('/evenementen/{event}', [EvenementenController::class, 'show'])->name('evenementen.show');

// announcements
Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

