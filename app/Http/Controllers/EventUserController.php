<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventUser; // Sesuaikan dengan nama model Anda
use App\Models\Event; // Sesuaikan dengan nama model Anda
use App\Models\User; // Sesuaikan dengan nama model Anda

class EventUserController extends Controller
{
    public function index()
    {
        $eventUsers = EventUser::all(); // Mengambil semua data event user
        return view('eventusers.index', compact('eventUsers')); // Menampilkan data di view
    }

    public function create()
    {
        $events = Event::all(); // Mengambil semua data event
        $users = User::all(); // Mengambil semua data user

        return view('eventusers.create', compact('events', 'users')); // Menampilkan form untuk membuat data baru

    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'event_id' => 'required|exists:events,id', // Contoh validasi
            'user_id' => 'required|exists:users,id', // Contoh validasi
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        EventUser::create($request->all()); // Menyimpan data baru
        return redirect()->route('eventusers.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $eventUser = EventUser::find($id);
        return view('eventusers.edit', compact('eventUser')); // Menampilkan form untuk mengedit data
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'event_id' => 'required|exists:events,id', // Contoh validasi
            'user_id' => 'required|exists:users,id', // Contoh validasi
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $eventUser = EventUser::find($id);
        $eventUser->update($request->all()); // Mengupdate data
        return redirect()->route('eventusers.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $eventUser = EventUser::find($id);
        $eventUser->delete(); // Menghapus data
        return redirect()->route('eventusers.index')->with('success', 'Data berhasil dihapus!');
    }
}