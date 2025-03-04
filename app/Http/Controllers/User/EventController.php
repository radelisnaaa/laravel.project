<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna terautentikasi yang bisa mengakses
    }

    public function index(): View
    {
        $events = Event::all();
        return view('user.events.index', compact('events'));
    }

    public function show($id): View
    {
        $event = Event::findOrFail($id);
        return view('user.events.show', compact('event'));
    }
}

