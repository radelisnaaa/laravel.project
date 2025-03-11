<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya admin yang bisa mengakses
        // $this->middleware(['auth', 'admin']);
    }

    public function adminDashboard()
    {
        // Ambil semua data dari database
        $events = Event::all();
        $orders = Order::all();
        $users = User::all();
        $tickets = Ticket::all();

        // Hitung jumlah entitas untuk ditampilkan di dashboard
        $jumlahEvent = $events->count();
        $jumlahOrder = $orders->count();
        $jumlahUser = $users->count();
        $jumlahTicket = $tickets->count();

        // Kirim data ke tampilan
        return view('admin.dashboard', compact(
            'events', 'orders', 'users', 'tickets',
            'jumlahEvent', 'jumlahOrder', 'jumlahUser', 'jumlahTicket'
        ));
    }
}
