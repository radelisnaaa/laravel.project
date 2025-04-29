<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class PublicEventController extends Controller
{
    /**
     * Menampilkan semua event untuk umum.
     */
    public function index()
    {
        $events = Event::latest()->paginate(12);
        return view('events.index', compact('events'));
    }

    /**
     * Menampilkan detail dari event tertentu.
     */
    public function show($id)
    {
        $event = Event::with('tickets', 'users')->findOrFail($id);

        // Cek apakah user sudah join event ini
        $isJoined = false;
        if (auth()->check()) {
            $isJoined = $event->users->contains(auth()->user()->id);
        }

        return view('events.show', compact('event', 'isJoined'));
    }
}
