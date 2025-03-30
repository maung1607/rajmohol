<?php

use App\Http\Controllers\Backend\RoomClassController;
use App\Http\Controllers\Backend\RoomController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    /*Room Class*/
    Route::get('/room-class/list', [RoomClassController::class, 'index'])->name('room.class.index');
    Route::get('/room-class/create', [RoomClassController::class, 'create'])->name('room.class.create');
    Route::post('/room-class/store', [RoomClassController::class, 'store'])->name('room.class.store');
    Route::get('/room-class/edit/{id}', [RoomClassController::class, 'edit'])->name('room.class.edit');
    Route::post('/room-class/update', [RoomClassController::class, 'update'])->name('room.class.update');
    Route::get('/room-class/delete/{id}', [RoomClassController::class, 'destroy'])->name('room.class.delete');
    Route::post('/room-class/data-list', [RoomClassController::class, 'getData'])->name('room.class.data.list');

    /*Room*/
    Route::get('/room/list',[RoomController::class,'index'])->name('room.index');
    Route::post('/room/data-list',[RoomController::class,'getData'])->name('room.data.list');
    Route::get('/room/create',[RoomController::class,'create'])->name('room.create');
    Route::post('/room/store',[RoomController::class,'store'])->name('room.store');
    Route::get('/room/edit/{id}',[RoomController::class,'edit'])->name('room.edit');
    Route::post('/room/update', [RoomController::class, 'update'])->name('room.update');
    Route::get('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');
});
