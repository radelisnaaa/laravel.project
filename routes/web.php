<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventUserController as AdminEventUserController;
use App\Http\Controllers\User\DashboardController;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
| Bisa diakses oleh semua orang, termasuk tamu.
*/
Route::get('/', function () {
    $events = Event::all();
    return view('home', compact('events'));
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// Halaman detail event
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Login
Route::post('/login', [UserController::class, 'login'])->name('user.login');

/*
|--------------------------------------------------------------------------
| User Routes (Harus Login)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user yang sudah login.
*/
Route::middleware(['auth'])->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Pesanan user
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'store']);
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Harus Admin)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user dengan role admin.
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        // Controller atau closure untuk tampilan dashboard
        return view('admin.dashboard', [
            'events' => \App\Models\Event::all(),
            'orders' => \App\Models\Order::all(),
            'users' => \App\Models\User::all(),
            'tickets' => \App\Models\Ticket::all()
        ]);
    })->name('dashboard');

    Route::resource('events', AdminEventController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('tickets', AdminTicketController::class);
});

Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/events/{event}', 'showEvent')->name('events.show');
    Route::get('/profile/edit', 'editProfile')->name('profile.edit');
    Route::post('/profile/update', 'updateProfile')->name('profile.update');
    Route::get('/profile/history', 'purchaseHistory')->name('profile.history');
    Route::get('/notifications', 'notifications')->name('notifications.index');
});


Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('public.events.show');
Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile.index');



    
/*
|--------------------------------------------------------------------------
| Tambahkan route autentikasi jika file auth.php ada
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
