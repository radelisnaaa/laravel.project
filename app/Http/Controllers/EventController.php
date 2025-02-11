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
    public function index() : View
    {
        // Get all events
        $events = Event::all();

        // Return the view with the events
        return view('events.index', compact('events'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('events.create');
    }


  

    /**
     * Store a newly created resource in storage.
    */
    public function store(StoreEventRequest $request): RedirectResponse
    {
       //validasi data
       $request->validate([
          'name' => 'required|string|max:255',
          'description' => 'required|string',
          'speaker' => 'required|string',
          'zoom_link' => 'nullable|url',
          'date' => 'required|date',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

       ]);
       

      
        // //simpan ke database
        // $event = Event::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'date' => $request->date,
        //     'image' => $request->file('image')->store('images', 'public'),
        //     'user_id' => Auth::id(),
        // ]);

        
        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to create an event');
        }

        // Upload the image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());

        // Create the event
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'speaker' => $request->speaker,
            'zoom_link' => $request->zoom_link,
            'date' => $request->date,
            'image' => $image->hashName(),
            'user_id' => Auth::id(),
        ]);

        // Redirect to the events index
        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $event = Event::find($id);

    if (!$event) {
        return abort(404, 'Event not found');
    }

    return view('events.show', compact('event'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event) : View
    {
        // Render the edit view with the event
        return view('events.edit', compact('event'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        // pastikan sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to update an event');
        }

        //upload the image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'zoom_link' => 'nullable|url',
        ]);
// Check if a new image is uploaded
if ($request->hasFile('image')) {
    // Validate and upload the image
    $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);

    $image = $request->file('image');
    $image->storeAs('public/images', $image->hashName());

    // Delete the old image
    Storage::delete('public/images/' . $event->image);

    // Update the event with the new image
    $event->update([
        'image' => $image->hashName(),
        'zoom_link' => $request->zoom_link,
    ]);
}

// Update the event without the image
$event->update([
    'name' => $request->name,
    'description' => $request->description,
    'date' => $request->date,
    'user_id' => Auth::id(),
]);

// Redirect to the events index
return redirect()->route('events.index')->with('success', 'Event updated successfully');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Event $event) : RedirectResponse
{
    // Ensure the user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You need to login to delete an event');
    }

    // Delete the image
    Storage::delete('public/images/' . $event->image);

    // Delete the event
    $event->delete();

    // Redirect to the events index
    return redirect()->route('events.index')->with('success', 'Event deleted successfully');
}

}