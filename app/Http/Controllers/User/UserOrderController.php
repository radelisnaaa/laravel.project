<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\EventUser;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('ticket.event')->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('ticket.event')->findOrFail($id);

        $formatted = [
            'total_price' => $order->total_price,
            'quantity' => $order->quantity,
            'event_name' => $order->ticket->event->name,
            'ticket_name' => $order->ticket->name,
            'status' => ucfirst($order->status),
        ];

        return view('user.orders.show', compact('order', 'formatted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $event = $ticket->event;

        if ($ticket->quota < $request->quantity) {
            return redirect()->route('events.index')->with('error', 'Stok tiket tidak mencukupi');
        }

        $totalPrice = $ticket->price * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $ticket->decrement('quota', $request->quantity);

        EventUser::firstOrCreate([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
        ]);

        return redirect()->route('user.orders.pay.with.midtrans', $order->id);
    }

public function payment($id)
{
    $order = Order::with('ticket.event')->where('user_id', Auth::id())->findOrFail($id);

    if ($order->status !== 'pending') {
        return redirect()->route('user.orders.index')
            ->with('error', 'Order ini sudah tidak dalam status pending.');
    }

    // Set konfigurasi midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;
    // Ambil snap token dari Midtrans Snap API

    // Hanya buat Snap Token jika belum ada
        if (!$order->snap_token) {
            $amount = $order->total_price;
            
            // Pastikan amount valid dan lebih besar dari 0
            if ($amount <= 0) {
            return view('user.orders.payment', [
                'order' => $order,
                'error' => 'Harga tidak valid. Silahkan hubungi admin.',
            ]);
            }

            $transaction = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id . '-' . time(),
                'gross_amount' => (int)$amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                'id' => $order->ticket->id,
                'price' => (int)$order->ticket->price,
                'quantity' => $order->quantity,
                'name' => $order->ticket->name . ' - ' . $order->ticket->event->name,
                ]
            ]
            ];
        $client = new Client();
        $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
            ],
            'json' => $transaction,
            'verify' => false, // jika SSL error di lokal
        ]);

        $body = json_decode($response->getBody(), true);
        $snapToken = $body['token'] ?? null;

        // Simpan snap_token ke database jika berhasil
        if ($snapToken) {
            $order->snap_token = $snapToken;
            $order->save();
        }
    }

            return view('user.orders.payment', [
                'order' => $order,
                'snapToken' => $order->snap_token
            ]);
       
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('user.orders.index')->with('success', 'Status order berhasil diperbarui');
    }

    // Jika kamu mau buat simulasi pembayaran manual (untuk testing)
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
