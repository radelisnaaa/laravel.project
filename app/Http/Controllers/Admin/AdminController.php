<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna yang terautentikasi yang bisa mengakses


        $events = Event::all();
        $orders = Order::all();
        $users = User::all();
        $tickets = Ticket::all();
        $payments = Payment::all();

        // Hitung jumlah entitas untuk ditampilkan di dashboard
        $jumlahEvent = is_countable($events) ? count($events) : 0;
        $jumlahOrder = is_countable($orders) ? count($orders) : 0;
        $jumlahUser = is_countable($users) ? count($users) : 0;
        $jumlahTicket = is_countable($tickets) ? count($tickets) : 0;
        $jumlahPayment = is_countable($payments) ? count($payments) : 0;

        return view('admin.dashboard', compact(
            'events', 'orders', 'users', 'tickets', 'payments',
            'jumlahEvent', 'jumlahOrder', 'jumlahUser', 'jumlahTicket', 'jumlahPayment'
        ));
    }
}

