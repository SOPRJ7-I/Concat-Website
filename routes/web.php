<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommunityNightController;
use App\Http\Controllers\SponsorController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationsController;
use App\Http\Controllers\RoostersController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AboutUsController;

// routes/web.php

// Community Nights
Route::resource('community-nights', CommunityNightController::class);

// Sponsors
Route::resource('sponsors', SponsorController::class);
Route::get('/sponsors/{sponsor}/edit-hidden', [SponsorController::class, 'editHidden'])->name('sponsors.edit-hidden');
Route::post('/sponsors/{sponsor}/force-delete', [SponsorController::class, 'forceDelete'])->name('sponsors.force-delete');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/registration', [RegistrationsController::class, 'store'])->name('registration');

Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/create', [EventController::class, 'store'])->name('events.store');
// routes/web.php
Route::get('/events/{event}/download-ics', [EventController::class, 'downloadIcs'])->name('events.ics');
Route::get('/events/download-ics', [EventController::class, 'DownloadAllICS'])->name('events.download-ics');


Route::get('/events/index', [EventController::class, 'index'])->name('events.index');
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);

Route::get('/community-nights/{id}/edit', [CommunityNightController::class, 'edit'])->name('community-nights.edit');

Route::put('/community-nights/{communityNight}/update', [CommunityNightController::class, 'update'])->name('community-nights.update');


Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

//galerij
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{photo}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
//Registreren
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// announcements


Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

//newsletters
Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/newsletters/create', [NewsletterController::class, 'create'])->name('newsletters.create');
    Route::post('/newsletters', [NewsletterController::class, 'store'])->name('newsletters.store');
    Route::get('newsletters/{newsletter}/edit', [NewsletterController::class, 'edit'])->name('newsletters.edit');
    Route::put('/newsletters/{newsletter}', [NewsletterController::class, 'update'])->name('newsletters.update');
    Route::get('/newsletters/{newsletter}', [NewsletterController::class, 'show'])->name(name: 'newsletters.show');


});

// assignments
Route::resource('/assignments',AssignmentController::class);

//about us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');

// Board Members
Route::get('/board-members/{id}/edit', [AboutUsController::class, 'edit_board_member'])->name('board-members.edit');
Route::put('/board-members/{id}', [AboutUsController::class, 'update_board_member'])->name('board-members.update');

// PreviousBoard

Route::get('/previous-boards/{id}/edit', [AboutUsController::class, 'edit_previous_board'])->name('previous-boards.edit');
Route::put('/previous-boards/{id}', [AboutUsController::class, 'update_previous_board'])->name('previous-boards.update');

//PROBLEMEN MET AUTHENTICATIE KIJK ERNAAR!!!
Route::middleware('auth')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Access denied');
        }
        return $next($request);
    }], function () {
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

        Route::get('/roosters', [RoostersController::class, 'index']);
        Route::post('/roosters', [RoostersController::class, 'store']);
        Route::delete('/roosters/{rooster}', [RoostersController::class, 'destroy'])->name('roosters.destroy');
    });
});
