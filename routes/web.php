<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about.us');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/booking', [FrontendController::class, 'booking'])->name('booking');
Route::get('/rooms', [FrontendController::class, 'rooms'])->name('rooms');
Route::get('/contact-us', [FrontendController::class, 'contactUs'])->name('contact.us');

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/room_routes.php';
require __DIR__.'/booking_routes.php';
