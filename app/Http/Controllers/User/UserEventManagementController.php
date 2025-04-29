<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class UserEventManagementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $myEvents = $user->events()->latest()->paginate(10);

        return view('user.events.index', compact('myEvents'));
    }

    public function show($id)
{
    $user = Auth::user();
    $event = Event::findOrFail($id);
    
    // Periksa apakah user sudah terdaftar pada event ini
    $isJoined = $event->users->contains($user->id); // Asumsi relasi sudah ada

    return view('user.events.show', compact('event', 'isJoined'));
}

}
