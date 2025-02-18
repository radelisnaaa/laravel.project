<?php

use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TicketController;  
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login'])->name('user.login');

Route::post('/eventusers/{memberId}/events/{eventId}', [MemberController::class, 'joinEvent'])->name('members.joinEvent');
Route::post('/event/register/{userId}/{eventId}', [EventUserController::class, 'registerToEvent'])->name('event.register');
Route::post('/event/unregister/{userId}/{eventId}', [EventUserController::class, 'unregisterFromEvent'])->name('event.unregister');
Route::get('/event/users/{eventId}', [EventUserController::class, 'eventUsers'])->name('event.users');
Route::get('/user/events/{userId}', [EventUserController::class, 'userEvent'])->name('events.index');
Route::get('/user/{id}', [UserController::class, 'show']);


Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/home', function () {
    $events = Event::all();
    return view('home', compact('events'));
});

// Menghapus member dari event
Route::delete('/members/{memberId}/events/{eventId}', [MemberController::class, 'leaveEvent'])->name('members.leaveEvent');

Route::resource('/events', EventController::class);
Route::resource('/users', UserController::class);
Route::resource('eventusers', EventUserController::class);
Route::resource('tickets', TicketController::class);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/event-user', [EventUserController::class, 'index'])->name('event-user.index');
    
    //Route::resource('events', EventController::class); 

    // Route::middleware(['admin'])->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
    

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
