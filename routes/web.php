<?php

use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\Ticket;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TicketController; 
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
// use App\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});


Route::post('/login', [UserController::class, 'login'])->name('user.login');

//Route::post('/eventusers/{memberId}/events/{eventId}', [MemberController::class, 'joinEvent'])->name('members.joinEvent');
// Route::post('/event/register/{userId}/{eventId}', [EventUserController::class, 'registerToEvent'])->name('event.register');
// Route::post('/event/unregister/{userId}/{eventId}', [EventUserController::class, 'unregisterFromEvent'])->name('event.unregister');
//Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
//Route::get('/event/users/{eventId}', [EventUserController::class, 'eventUsers'])->name('event.users');
//Route::get('/user/events/{userId}', [EventUserController::class, 'userEvent'])->name('events.index');
//Route::get('/user/{id}', [UserController::class, 'show']);
//Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
//Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');






Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/', function () {
    $events = Event::all();
    return view('home', compact('events'));
});

// Menghapus member dari event
// Route::delete('/members/{memberId}/events/{eventId}', [MemberController::class, 'leaveEvent'])->name('members.leaveEvent');

Route::resource('/events', EventController::class);
Route::resource('/users', UserController::class);
Route::resource('eventusers', EventUserController::class);
Route::resource('tickets', TicketController::class);
Route::resource('orders', OrderController::class);
Route::resource('/events', AdminEventController::class);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('tickets', TicketController::class)->except(['index', 'show']);
    //Route::post('/orders', [OrderController::class, 'store']);
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
        Route::resource('events', EventController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class);
        Route::resource('tickets', TicketController::class);
        Route::resource('payments', PaymentController::class);
        
    });
    Route::get('/event-user', [EventUserController::class, 'index'])->name('event-user.index');
    Route::resource('/events', EventController::class);
    Route::resource('/events', AdminEventController::class);
});
    
Route::resource('tickets', TicketController::class)->only(['index', 'show']);

Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');


Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




require __DIR__.'/auth.php';
