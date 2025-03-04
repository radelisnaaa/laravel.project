<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Menampilkan daftar semua event (untuk admin).
     */
    public function index(): View
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form untuk membuat event baru (untuk admin).
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * Menyimpan event baru (untuk admin).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string',
            'zoom_link' => 'nullable|url',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('public/event');

        // Simpan event ke database
        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'zoom_link' => $request->zoom_link,
            'date' => $request->date,
            'image' => str_replace('public/', '', $imagePath),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat');
    }

    /**
     * Menampilkan detail event tertentu (untuk admin).
     */
    public function show(Event $event): View
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Menampilkan form edit event (untuk admin).
     */
    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Memperbarui event yang ada (untuk admin).
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speaker' => 'required|string',
            'zoom_link' => 'nullable|url',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $event->image);
            $imagePath = $request->file('image')->store('public/event');
            $event->update(['image' => str_replace('public/', '', $imagePath)]);
        }

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'zoom_link' => $request->zoom_link,
            'date' => $request->date,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui');
    }

    /**
     * Menghapus event (untuk admin).
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete('public/' . $event->image);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }
}
