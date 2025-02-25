<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Ambil semua event
        $events = Event::all();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string',
            'zoom_link' => 'nullable|url',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to create an event');
        }

        // Simpan gambar
        $image = $request->file('image');
        $imagePath = $image->store('public/event');

        // Simpan ke database
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'zoom_link' => $request->zoom_link,
            'date' => $request->date,
            'image' => str_replace('public/', '', $imagePath), // Simpan path tanpa 'public/'
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        //$event = Event::with('tickets')->findOrFail($id); // Mengambil data acara berdasarkan ID
        return view('events.show', compact('event')); // Mengirim data ke view

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to update an event');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string',
            'zoom_link' => 'nullable|url',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image) {
                Storage::delete('public/' . $event->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imagePath = $image->store('public/event');

            // Update data event dengan gambar baru
            $event->update([
                'image' => str_replace('public/', '', $imagePath),
            ]);
        }

        // Update event tanpa mengganti gambar jika tidak ada gambar baru yang diunggah
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'zoom_link' => $request->zoom_link,
            'date' => $request->date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to delete an event');
        }

        // Hapus gambar jika ada
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        // Hapus event dari database
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
}
