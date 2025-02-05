<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use\App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\View\View;


class EventUserrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerToEvent($userId, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = User::findOrFail($userId);

        // Check if the user is already registered for the event
        if ($event->users->contains($user)) {
            return redirect()->back()->with('success', 'Kamu sudah terdaftar pada event ini');
        } else {
            // Register the user for the event
            $event->users()->attach($user);
            return redirect()->back()->with('success', 'Kamu berhasil terdaftar pada event ini');
        }
    }
    
    public function unregisterFromEvent($userId, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = User::findOrFail($userId);

        // Check if the user is registered for the event
        if ($event->users->contains($user)) {
            // Unregister the user from the event
            $event->users()->detach($user);
            return redirect()->back()->with('success', 'Kamu berhasil keluar dari event ini');
        } else {
            return redirect()->back()->with('error', 'Kamu tidak terdaftar pada event ini');
        }
    }

    //menampilkan semua event yang diikuti oleh user
    public function userEvent($userId) : View
    {
        $user = User::findOrFail($userId);
        $events = $user->events;
        return view('events.index', compact('events'));
    }

    //menampilkan daftar peserta acara tertentu
    public function eventUsers($eventId) : View
    {
        $event = Event::findOrFail($eventId);
        $users = $event->users;
        return view('events.event_users', compact('event', 'users'));
    }
}



