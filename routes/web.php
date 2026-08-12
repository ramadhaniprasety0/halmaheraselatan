<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TravelPackageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/packages', [TravelPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [TravelPackageController::class, 'show'])->name('packages.show');

use App\Http\Controllers\MapController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\CulinaryController;
Route::get('/map', [MapController::class, 'index'])->name('map.index');

Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
Route::get('/accommodations/{slug}', [AccommodationController::class, 'show'])->name('accommodations.show');

Route::get('/culinary', [CulinaryController::class, 'index'])->name('culinary.index');
Route::get('/culinary/{slug}', [CulinaryController::class, 'show'])->name('culinary.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/destinations', 'admin.destinations')->name('destinations');
    Route::view('/events', 'admin.events')->name('events');
    Route::view('/accommodations', 'admin.accommodations')->name('accommodations');
    Route::view('/packages', 'admin.packages')->name('packages');
    Route::view('/reviews', 'admin.reviews')->name('reviews');
    Route::view('/users', 'admin.users')->name('users');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
