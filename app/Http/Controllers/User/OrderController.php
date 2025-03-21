<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\EventUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::find($request->ticket_id);
        $event = $ticket->event;

        if ($ticket->quota < $request->quantity) {
            return redirect()->route('events.index')->with('error', 'Not enough tickets available');
        }

        $totalPrice = $ticket->price * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Kurangi stok tiket
        $ticket->decrement('quota', $request->quantity);

        // Daftarkan user ke event jika belum terdaftar
        EventUser::firstOrCreate([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order created successfully');
    }

    public function index()
    {
    // Mengambil semua order berdasarkan user yang sedang login
    $orders = Order::where('user_id', Auth::id())->with('ticket.event')->get();

    return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
    //$tickets = Ticket::where('order_id', $orderId)->get();
    $order = Order::findOrFail($id);

    return view('orders.show', compact('order'));
    }

}

