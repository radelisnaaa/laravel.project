<!-- resources/views/user/orders/show.blade.php -->

<h3>Detail Order</h3>

<p><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
<p><strong>Tiket:</strong> {{ $order->ticket->name }}</p>
<p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
<p><strong>Total:</strong> Rp{{ number_format($order->total_price) }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

<a href="{{ route('user.orders.index') }}" class="btn btn-secondary btn-sm">Kembali</a>

@if ($order->status === 'pending')
    <a href="{{ route('user.orders.pay', $order->id) }}" class="btn btn-success btn-sm">Bayar Sekarang</a>
@endif
