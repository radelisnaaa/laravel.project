<?php
namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        $history = $user->history; // Ambil riwayat pembelian dari relasi history

        return view('user.dashboard', compact('history'));
    }
}
