<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;

class UserEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10); // bisa pakai paginate atau all()
        return view('user.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return view('user.events.show', compact('event'));
    }
}
