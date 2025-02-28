<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd;
        }

        .container {
            max-width: 900px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert-success,
        .alert-danger {
            border-radius: 10px;
        }

        h1 {
            color: #007bff;
        }

        .btn {
            border-radius: 5px;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>

<div class="container mt-5">
    <h2 class="mb-4">Daftar Tiket yang Anda Beli</h2>

    @if($orders->count() > 0)
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->ticket->name }}</h5>
                            <p class="card-text"><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
                            <p class="card-text"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                            <p class="card-text"><strong>Total Harga:</strong> Rp{{ number_format($order->total_price) }}</p>
                            <p class="card-text"><strong>Tanggal Pembelian:</strong> {{ $order->created_at->format('d F Y') }}</p>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                <i class="fas fa-ticket-alt"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Anda belum membeli tiket apapun.</p>
    @endif

    <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Event
    </a>
</div>

