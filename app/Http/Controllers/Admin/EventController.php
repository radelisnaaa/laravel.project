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
    public function index(): View
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
{
$request->validate([
    'name' => 'required|string',
    'description' => 'required|string',
    'speaker' => 'required|string',
    'zoom_link' => 'nullable|url',
    'date' => 'required|date',
    'start_time' => 'required|date_format:H:i',
    'end_time' => 'required|date_format:H:i',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);

$startDateTime = $request->date . ' ' . $request->start_time;
$endDateTime = $request->date . ' ' . $request->end_time;

$imagePath = $request->file('image')->store('public/event');

Event::create([
    'name' => $request->name,
    'description' => $request->description,
    'speaker' => $request->speaker,
    'zoom_link' => $request->zoom_link,
    'date' => $request->date,    
    'start_time' => $startDateTime,
    'end_time' => $endDateTime,
    'image' => str_replace('public/', '', $imagePath),
    'user_id' => Auth::id(),
]);

    return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat');
}


    public function show(Event $event): View
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'speaker' => 'required|string',
        'zoom_link' => 'nullable|url',
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Gabungkan date + time
    $startDateTime = $request->date . ' ' . $request->start_time;
    $endDateTime = $request->date . ' ' . $request->end_time;

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
        'start_time' => $startDateTime,
        'end_time' => $endDateTime,
    ]);

    return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui');
}

    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete('public/' . $event->image);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }
}
