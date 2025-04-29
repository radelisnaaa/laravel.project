<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // Ini harus ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller // Pastikan mewarisi Controller yang benar
{
    // Menampilkan profil pengguna
    public function show()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('user.profile', compact('user'));
    }

    // Menampilkan form edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    // Memproses update data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update data
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika ada password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
