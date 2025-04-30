<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan Saya</title>
</head>
<body>
    <h1>Riwayat Pesanan</h1>

    @if($orders->isEmpty())
        <p>Kamu belum pernah melakukan pemesanan.</p>
    @else
        <ul>
            @foreach($orders as $order)
                <li>Order ID: {{ $order->id }} - Status: {{ $order->status }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
