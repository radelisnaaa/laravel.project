<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Tampilkan semua notifikasi milik user login
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();

        return view('user.notifications.index', compact('notifications'));
    }

    // Tandai notifikasi sebagai dibaca
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi ditandai sebagai dibaca.');
    }

    // Hapus notifikasi
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }
}
