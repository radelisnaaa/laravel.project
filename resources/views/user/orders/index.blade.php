<!-- resources/views/user/orders/index.blade.php -->

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2>Daftar Order Kamu</h2>

@foreach ($orders as $order)
    <div class="card mb-3 p-3 border">
        <h4>{{ $order->ticket->event->name }}</h4>
        <p>Tiket: {{ $order->ticket->name }}</p>
        <p>Jumlah: {{ $order->quantity }}</p>
        <p>Total Harga: Rp{{ number_format($order->total_price) }}</p>
        <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>

        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>

        @if ($order->status === 'pending')
            <a href="{{ route('user.orders.pay', $order->id) }}" class="btn btn-success btn-sm">Bayar</a>
        @endif
    </div>
@endforeach
