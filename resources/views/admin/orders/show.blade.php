<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>


<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Detail Order #{{ $order->id }}</h2>
            <p class="card-text"><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
            <p class="card-text"><strong>Tiket:</strong> {{ $order->ticket->id }}</p>
            <p class="card-text"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
            <p class="card-text"><strong>Total Harga:</strong> Rp{{ number_format($order->total_price) }}</p>
            <p class="card-text"><strong>Tanggal Pembelian:</strong> {{ $order->created_at->format('d F Y') }}</p>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tiket
            </a>
        </div>
    </div>
</div>

