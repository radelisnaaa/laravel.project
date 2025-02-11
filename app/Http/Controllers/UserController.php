<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    

    /**
     * Menampilkan detail pengguna berdasarkan ID.
     */
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,participant,organizer',
            'phone' => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
           // 'avatar' => 'nullable|string'
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'organization' => $request->organization,
           // 'avatar' => $request->avatar
        ]);
    
        return redirect()->route('users.index')->with('message', 'User berhasil dibuat');
    }

    public function show($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return view('user.show', compact('user')); // Menampilkan halaman error jika user tidak ditemukan
        } else {
            return redirect()->route('users.show', compact('user'));
        }
    
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     */
    
    /**
     * Memperbarui data pengguna.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return view('errors.404'); // Menampilkan halaman error jika user tidak ditemukan
        }
    
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|in:admin,participant,organizer',
            'phone' => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            //'avatar' => 'nullable|string'
        ]);
    
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->update($request->except('password'));
    
        return redirect()->route('users.show', $id)->with('message', 'User berhasil diperbarui');
    }
    
    /**
     * Menghapus pengguna.
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        if (!$user) {
            return view('errors.404'); // Menampilkan halaman error jika user tidak ditemukan
        }
    
        $user->delete();
    
        return redirect()->route('users.index')->with('message', 'User berhasil dihapus');
    }
    

    /**
     * Login pengguna.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
        }
    
        $user = Auth::user();
    
        // Setelah login berhasil, alihkan ke dashboard atau halaman utama
        return redirect()->route('dashboard')->with('message', 'Login berhasil');
    }
    
    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return redirect()->route('login')->with('message', 'Logout berhasil');
}

}
