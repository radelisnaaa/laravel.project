<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Tampilkan semua notifikasi milik user login
   public function index()
{
    $notifications = Auth::user()->notifications()->latest()->get();
    return view('user.notifications.index', compact('notifications'));
}


    // Tandai notifikasi sebagai dibaca
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    // Hapus notifikasi
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->firstOrFail();
        $notification->delete();
        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
