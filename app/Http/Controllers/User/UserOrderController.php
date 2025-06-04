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
    // Ambil order beserta relasinya
    $order = Order::with('ticket.event')->findOrFail($id);

    // Format harga menggunakan helper rupiah()
    $formatted = [
        'total_price' => ($order->total_price),
        'quantity' => $order->quantity,
        'event_name' => $order->ticket->event->name,
        'ticket_name' => $order->ticket->name,
        'status' => ucfirst($order->status),
    ];

    return view('user.orders.show', compact('order', 'formatted'));
}


    // Update status order, misal untuk admin update atau fitur lain (optional)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('user.orders.index')->with('success', 'Status order berhasil diperbarui');
    }

    // Method bayar: update status order jadi paid
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'pending') {
            return redirect()->route('user.orders.index')->with('error', 'Order sudah dibayar atau dibatalkan.');
        }

        $order->status = 'paid';
        $order->save();

        return redirect()->route('user.orders.index')->with('success', 'Pembayaran berhasil dilakukan!');
    }
}
