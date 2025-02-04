<?php

use App\Http\Controllers\EventController;
use App\Http\Models\Event;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login'])->name('user.login');

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/events', \App\Http\Controllers\EventController::class);
Route::resource('/users', \App\Http\Controllers\UserController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



    Route::middleware(['auth'])->group(function () {
    Route::Resource('events', EventController::class); 
    Route::middleware(['admin'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    });

require __DIR__.'/auth.php';
