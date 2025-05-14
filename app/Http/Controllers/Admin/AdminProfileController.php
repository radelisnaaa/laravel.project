<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // Menampilkan profil admin
    public function show()
    {
        $admin = Auth::user(); // Ambil data admin yang sedang login
        return view('admin.profile', compact('admin'));
    }

    // Menampilkan form edit profil admin
   public function edit()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        return view('admin.profile-edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui.');
}


    public function history()
    {
        // Contoh: ambil data aktivitas admin atau histori lainnya jika diperlukan
        // Jika tidak ada histori, bisa dihapus atau dikembangkan lebih lanjut
        return view('admin.history');
    }
}
