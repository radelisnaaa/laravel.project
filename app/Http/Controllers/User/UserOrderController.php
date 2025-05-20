<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    // Tampilkan daftar order milik user yang login
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('ticket.event')->latest()->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    // Tampilkan detail order user berdasarkan ID
    public function show($id)
    {
        $order = Order::with('ticket.event')->where('user_id', Auth::id())->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    // Update status order, misal untuk admin update atau fitur lain (optional)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('user.profile.history')->with('success', 'Status order berhasil diperbarui');
    }

    // Method bayar: update status order jadi paid
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'pending') {
            return redirect()->route('user.profile.history')->with('error', 'Order sudah dibayar atau dibatalkan.');
        }

        $order->status = 'paid';
        $order->save();

        return redirect()->route('user.profile.history')->with('success', 'Pembayaran berhasil dilakukan!');
    }
}
