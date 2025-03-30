<?php

use App\Http\Controllers\Backend\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    /*Room Class*/
    Route::get('/booking/list', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/getData', [BookingController::class, 'getData'])->name('booking.get.data');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/edit/{booking_id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::post('/booking/update', [BookingController::class, 'update'])->name('booking.update');
    Route::get('/booking/details/{booking_id}', [BookingController::class, 'details'])->name('booking.details');
    Route::post('/booking/delete/{booking_id}', [BookingController::class, 'delete'])->name('booking.delete');
    Route::get('/booking/{booking_id}/pdf', [BookingController::class, 'generatePdf'])->name('booking.pdf');
    Route::get('/booking/complete/{booking_id}', [BookingController::class, 'completeBooking'])->name('booking.complete');
});
