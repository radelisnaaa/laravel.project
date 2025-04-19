<div class="card">
    <div class="card-body">
        <h5 class="card-title">Detail Order</h5>
        <p><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
        <p><strong>Jenis Tiket:</strong> {{ $order->ticket->ticket_type }}</p>
        <p><strong>Total Harga:</strong> {{ number_format($order->total_price, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $order->quantity }}</p>
        <a href="{{ route('user.orders.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
