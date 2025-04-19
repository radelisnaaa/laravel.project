<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        // Ambil data orders yang terkait dengan user yang sedang login dan lakukan pagination
        $user = Auth::user();
        $orders = $user->orders()->with('ticket.event')->latest()->paginate(10);  // Pagination dengan 10 data per halaman

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Ambil data order berdasarkan ID dan pastikan hanya bisa melihat miliknya
        $order = Order::with('ticket.event')->where('user_id', Auth::id())->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    // Method untuk mengupdate status order (optional)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Validasi dan update status order
        $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('user.orders.index')->with('success', 'Status order berhasil diperbarui');
    }
}
