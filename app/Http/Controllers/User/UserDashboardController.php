<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $eventCount = Event::count();
        $orderCount = Order::where('user_id', $user->id)->count();
        $historyCount = History::where('user_id', $user->id)->count();
        $notifications = $user->notifications()->latest()->take(5)->get();
        $recommendedEvents = Event::latest()->take(5)->get();

        return view('user.dashboard', [
            'notifications' => $notifications,
            'eventCount' => $eventCount,
            'orderCount' => $orderCount,
            'historyCount' => $historyCount,
            'recommendedEvents' => $recommendedEvents,
        ]);
    }
}