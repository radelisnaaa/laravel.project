<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event kepada publik.
     */
    public function index()
    {
        $events = Event::where('status', 'published')->get(); // Hanya tampilkan event yang dipublish
        return view('public.events.index', compact('events'));
    }

    /**
     * Menampilkan detail event kepada publik.
     */
    public function show($id)
    {
        $event = Event::where('status', 'published')->findOrFail($id);
        return view('public.events.show', compact('event'));
    }
}
