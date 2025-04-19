<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan dan Tiket Tersedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 900px;
            width: 100%;
        }

        .section-title {
            color: #1e88e5;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.8em;
        }

        .card-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Sedikit lebar minimal */
            gap: 15px;
            margin-bottom: 30px;
        }

        .square-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border-left: 3px solid;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            aspect-ratio: 1 / 1;
            padding: 15px;
            text-align: center;
        }

        .order-card {
            border-left-color: #29b6f6; /* Light blue for orders */
        }

        .ticket-card {
            border-left-color: #4caf50; /* Green for tickets */
        }

        .card-icon {
            font-size: 1.3em; /* Sedikit lebih kecil */
            color: #1e88e5;
            margin-bottom: 5px; /* Sedikit lebih kecil */
        }

        .card-info {
            font-size: 0.85em; /* Sedikit lebih kecil */
            color: #555;
            margin-bottom: 3px; /* Sedikit lebih kecil */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-info strong {
            color: #333;
            font-weight: bold;
        }

        .btn-primary,
        .btn-secondary {
            border-radius: 6px;
            padding: 5px 8px; /* Lebih kecil */
            font-size: 0.75em; /* Lebih kecil */
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 5px; /* Lebih kecil */
        }

        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }

        .btn-secondary {
            background-color: #78909c;
            border-color: #78909c;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #546e7a;
            border-color: #546e7a;
        }

        .no-data {
            color: #777;
            font-style: italic;
            text-align: center;
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
            display: block;
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #1e88e5;
            text-decoration: underline;
        }

        .badge-success,
        .badge-danger {
            border-radius: 4px;
            padding: 0.2em 0.4em;
            font-size: 0.65em; /* Lebih kecil */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="section-title"><i class="fas fa-shopping-cart me-2"></i> Pesanan Tiket</h2>

        <div class="card-list">
            @if($orders->count() > 0)
                @foreach ($orders as $order)
                    <div class="square-card order-card">
                        <i class="fas fa-receipt card-icon"></i>
                        <h5 class="card-info" style="font-weight: bold;">{{ $order->ticket->name }}</h5>
                        <p class="card-info"><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
                        <p class="card-info"><strong>Pembeli:</strong> {{ $order->user->name }}</p>
                        <p class="card-info"><small>{{ $order->user->email }}</small></p>
                        <p class="card-info"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                        <p class="card-info"><strong>Total:</strong> Rp{{ number_format($order->total_price) }}</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary"><i class="fas fa-eye me-1"></i> Detail</a>
                    </div>
                @endforeach
            @else
                <p class="no-data">Belum ada pesanan.</p>
            @endif
        </div>

        <h2 class="section-title"><i class="fas fa-ticket-alt me-2"></i> Tiket Tersedia</h2>

        <div class="card-list">
            @if($tickets->count() > 0)
                @foreach ($tickets as $ticket)
                    <div class="square-card ticket-card">
                        <i class="fas fa-tag card-icon"></i>
                        <h5 class="card-info" style="font-weight: bold;">{{ $ticket->name }}</h5>
                        <p class="card-info"><strong>Event:</strong> {{ $ticket->event->name }}</p>
                        <p class="card-info"><strong>Harga:</strong> Rp{{ number_format($ticket->price) }}</p>
                        <p class="card-info"><strong>Sisa Stok:</strong>
                            @if ($ticket->stock > 0)
                                <span class="badge-success">{{ $ticket->stock }}</span>
                            @else
                                <span class="badge-danger">Habis</span>
                            @endif
                        </p>
                        <p class="card-info"><small>Terakhir diperbarui: {{ $ticket->updated_at->format('d M Y') }}</small></p>
                    </div>
                @endforeach
            @else
                <p class="no-data">Belum ada tiket.</p>
            @endif
        </div>

        <a href="{{ route('admin.events.index') }}" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Event
        </a>
    </div>
</body>

</html>