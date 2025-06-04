<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
//admin 

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventUserController as AdminEventUserController;
use App\Http\Controllers\Admin\AdminProfileController as AdminProfileController;
//user

use App\Http\Controllers\User\UserDashboardController;
//use App\Http\Controllers\User\UserEventController;
use App\Http\Controllers\User\UserEventManagementController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserOrderController;



use App\Http\Controllers\PublicEventController;
// use App\Http\Controllers\User\UserDashboardController;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
| Bisa diakses oleh semua orang, termasuk tamu.
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// Halaman detail event
//Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');




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
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // Route::get('/orders', [ProfileController::class, 'index'])->name('profile.index');
    

    // Pesanan user
    //Route::resource('orders', OrderController::class)->only(['index', 'show', 'store']);

/*
|--------------------------------------------------------------------------
| Admin Routes (Harus Admin)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user dengan role admin.
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile'); // Ini route('admin.profile')
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');;
    Route::put('/profile', [AdminProfileController::class, 'edit'])->name('profile-edit');
    Route::get('/profile/show', [AdminProfileController::class, 'show'])->name('profile.show');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::resource('events', AdminEventController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('tickets', AdminTicketController::class);
});

Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    // Route untuk halaman dashboard user
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
     Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

    // Route untuk event user
    Route::get('/events', [UserEventManagementController::class, 'index'])->name('events');
    Route::get('/event/{id}', [UserEventManagementController::class, 'show'])->name('events.detail');
    Route::get('/events/{id}', [UserEventManagementController::class, 'show'])->name('events.show');

    // Route untuk manage event (admin atau pengguna yang mengelola event)
    Route::get('/manage-events', [UserEventManagementController::class, 'index'])->name('manage-events.index');
    Route::get('/manage-events/{id}', [UserEventManagementController::class, 'show'])->name('manage-events.show');

    
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::resource('orders', UserOrderController::class);
        //Route::get('/profile/history', [UserProfileController::class, 'history'])->name('profile.history');
        Route::get('orders/{order}/pay', [UserOrderController::class, 'pay'])->name('orders.pay');  // << ini route untuk bayar
    });
    

    //Route::get('/orders', [
       // OrderController::class, 'index'])->name('orders');

    


    // Route untuk notifikasi
    Route::get('/notifications', [UserDashboardController::class, 'notifications'])->name('notifications.index');
});




Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('public.events.show');
// Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
// Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
// Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');

Route::get('/explore-events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/explore-events/{id}', [PublicEventController::class, 'show'])->name('events.show');





    
/*
|--------------------------------------------------------------------------
| Tambahkan route autentikasi jika file auth.php ada
|--------------------------------------------------------------------------
*/
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
