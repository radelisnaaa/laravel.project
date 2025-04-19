<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('ticket.event')->latest()->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('ticket.event')->where('user_id', Auth::id())->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }
}
