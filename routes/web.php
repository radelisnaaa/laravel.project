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
Route::prefix('admin')->middleware(['auth', 'admin'])->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');

    Route::resources([
        'events'  => AdminEventController::class,
        'orders'  => AdminOrderController::class,
        'users'   => AdminUserController::class,
        'tickets' => AdminTicketController::class,
    ]);
});

/*
|--------------------------------------------------------------------------
| Tambahkan route autentikasi jika file auth.php ada
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
