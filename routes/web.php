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

Route::get('/events/index', [EventController::class, 'index'])->name('events.index');
Route::get('/community-nights/create', [CommunityNightController::class, 'create']);

Route::get('/community-nights/{id}/edit', [CommunityNightController::class, 'edit'])->name('community-nights.edit');

Route::put('/community-nights/{communityNight}/update', [CommunityNightController::class, 'update'])->name('community-nights.update');


Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

//galerij
Route::get('/gallery/gallery', [GalleryController::class, 'index']);

Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name('show.login');
//Registreren
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

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/announcements', [AnnouncementController::class, 'adminIndex'])->name('announcements.admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/news', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::get('/newsletters/{newsletter}', [NewsletterController::class, 'show'])->name('newsletters.show');
    Route::post('/newsletters', [NewsletterController::class, 'store'])->name('newsletters.store');
Route::get('/news/create', [NewsletterController::class, 'create'])->name('news.create');

});

// assignments
Route::resource('/assignments',AssignmentController::class);

//about us
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
