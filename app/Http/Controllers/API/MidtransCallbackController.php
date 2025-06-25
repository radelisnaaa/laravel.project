<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Inisialisasi Midtrans notification
        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $orderId = $notif->order_id; // contoh: "ORDER-123"
        $fraudStatus = $notif->fraud_status;

        // Ambil ID asli jika kamu pakai format custom, misal "ORDER-{id}"
        $order_id = str_replace('ORDER-', '', $orderId);
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status berdasarkan Midtrans
        if ($transactionStatus === 'capture') {
            if ($paymentType === 'credit_card') {
                if ($fraudStatus === 'challenge') {
                    $order->status = 'pending';
                } else {
                    $order->status = 'paid';
                }
            }
        } elseif ($transactionStatus === 'settlement') {
            $order->status = 'paid';
        } elseif ($transactionStatus === 'pending') {
            $order->status = 'pending';
        } elseif ($transactionStatus === 'deny' || $transactionStatus === 'expire' || $transactionStatus === 'cancel') {
            $order->status = 'cancelled';
        }

        $order->save();

        return response()->json(['message' => 'Callback processed successfully']);
    }
}
