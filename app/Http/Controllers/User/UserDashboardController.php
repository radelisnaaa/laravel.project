<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Event;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('ticket')->get();
        $events = Event::latest()->take(3)->get();

        return view('user.dashboard', compact('orders', 'events'));
    }
}
