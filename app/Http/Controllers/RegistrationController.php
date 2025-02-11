<?php

// app/Http/Controllers/RegistrationController.php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Menampilkan semua pendaftaran
    public function index()
    {
        $registrations = Registration::with(['user', 'event'])->get();
        return view('registrations.index', compact('registrations'));
    }

    // Menampilkan form untuk menambah pendaftaran
    public function create()
    {
        $users = User::all();
        $events = Event::all();
        return view('registrations.create', compact('users', 'events'));
    }

    // Menyimpan data pendaftaran baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|string',
        ]);

        Registration::create($request->all());
        return redirect()->route('registrations.index')->with('success', 'Pendaftaran berhasil!');
    }

    // Menampilkan form untuk mengedit pendaftaran
    public function edit($id)
    {
        $registration = Registration::findOrFail($id);
        $users = User::all();
        $events = Event::all();
        return view('registrations.edit', compact('registration', 'users', 'events'));
    }

    // Memperbarui data pendaftaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|string',
        ]);

        $registration = Registration::findOrFail($id);
        $registration->update($request->all());
        return redirect()->route('registrations.index')->with('success', 'Pendaftaran berhasil diperbarui!');
    }

    // Menghapus data pendaftaran
    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return redirect()->route('registrations.index')->with('success', 'Pendaftaran berhasil dihapus!');
    }
}
