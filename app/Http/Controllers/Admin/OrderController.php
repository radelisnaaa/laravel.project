<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    // protected function middleware()
    // {
    //     $this->middleware('auth');  // Pastikan pengguna login
    //     $this->middleware('admin'); // Hanya admin yang bisa mengakses controller ini
    // }
    
    // protected $middleware = [
    //     'auth',
    //     'admin'
    // ];

    /**
     * Menampilkan semua order (khusus admin).
     */
    public function index(): View
    {
        $orders = Order::with(['user', 'ticket.event'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail order tertentu (khusus admin).
     */
    public function show($id): View
    {
        $order = Order::with(['user', 'ticket.event'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengupdate status order (khusus admin).
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status berhasil diperbarui');
    }

    /**
     * Menghapus order (khusus admin).
     */
    public function destroy($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        
        // Kembalikan stok tiket jika order dihapus
        $ticket = $order->ticket;
        $ticket->increment('quota', $order->quantity);

        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dihapus');
    }
}
