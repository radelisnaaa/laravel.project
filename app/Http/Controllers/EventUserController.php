<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\EventUser; 
use App\Models\Event; 
use App\Models\User; 

class EventUserController extends Controller
{
    // Menampilkan daftar event users
    public function index(): View
    {
        $user = auth()->user(); // Ambil user yang sedang login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        // Ambil semua data EventUser dengan relasi event dan user
        $eventUsers = EventUser::with(['event', 'user'])->get();
        
        return view('eventusers.index', compact('eventUsers'));
    }

    // Menampilkan halaman form tambah event user
    public function create(): View
    {
        $events = Event::all(); // Mengambil semua event
        $users = User::all(); // Mengambil semua user

        return view('eventusers.create', compact('events', 'users'));
    }

    // Menyimpan data event user yang baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Menyimpan data baru
        EventUser::create($request->only(['event_id', 'user_id']));
        
        return redirect()->route('eventusers.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan detail event user tertentu
    public function show($id): View
    {
        $eventUser = EventUser::findOrFail($id);
        return view('eventusers.show', compact('eventUser'));
    }

    // Menampilkan halaman edit event user
    public function edit($id): View
    {
        $eventUser = EventUser::findOrFail($id);
        $events = Event::all();
        $users = User::all();

        return view('eventusers.edit', compact('eventUser', 'events', 'users'));
    }

    // Mengupdate data event user tertentu
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Cari data EventUser berdasarkan ID
        $eventUser = EventUser::findOrFail($id);

        // Update data event user
        $eventUser->update($request->only(['event_id', 'user_id']));
        
        return redirect()->route('eventusers.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus event user tertentu
    public function destroy($id)
    {
        // Cari data EventUser berdasarkan ID dan hapus
        $eventUser = EventUser::findOrFail($id);
        $eventUser->delete();

        return redirect()->route('eventusers.index')->with('success', 'Data berhasil dihapus!');
    }
}
