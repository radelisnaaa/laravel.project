<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserTicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua tiket dari order user
        $orders = $user->orders()->with('ticket.event')->get();

        return view('user.tickets.index', compact('orders'));
    }
}
