<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\EventUser;
use App\Models\Event;
use App\Models\User;

class EventUserController extends Controller
{
    protected $middleware = ['auth', 'admin']; // Pastikan pengguna login dan hanya admin yang bisa mengakses controller ini

    /**
     * Menampilkan daftar event user (khusus admin).
     */
    public function index(): View
    {
        $eventUsers = EventUser::with(['event', 'user'])->get();
        return view('admin.eventusers.index', compact('eventUsers'));
    }

    /**
     * Menampilkan form untuk membuat data event user (khusus admin).
     */
    public function create(): View
    {
        $events = Event::all();
        $users = User::all();
        return view('admin.eventusers.create', compact('events', 'users'));
    }

    /**
     * Menyimpan data event user baru (khusus admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        EventUser::create($request->all());

        return redirect()->route('admin.eventusers.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail event user tertentu (khusus admin).
     */
    public function show($id): View
    {
        $eventUser = EventUser::with(['event', 'user'])->findOrFail($id);
        return view('admin.eventusers.show', compact('eventUser'));
    }

    /**
     * Menampilkan form edit event user (khusus admin).
     */
    public function edit($id): View
    {
        $eventUser = EventUser::findOrFail($id);
        $events = Event::all();
        $users = User::all();
        return view('admin.eventusers.edit', compact('eventUser', 'events', 'users'));
    }

    /**
     * Memperbarui data event user (khusus admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $eventUser = EventUser::findOrFail($id);
        $eventUser->update($request->all());

        return redirect()->route('admin.eventusers.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus event user (khusus admin).
     */
    public function destroy($id)
    {
        $eventUser = EventUser::findOrFail($id);
        $eventUser->delete();

        return redirect()->route('admin.eventusers.index')->with('success', 'Data berhasil dihapus!');
    }
}
