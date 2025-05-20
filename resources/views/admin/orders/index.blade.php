@extends('layouts.admin-app')

@section('content')
    <div class="container mt-5">
        <h2 class="section-title"><i class="fas fa-shopping-cart me-2"></i> Daftar Pesanan</h2>

        <div class="table-responsive">
            @if($orders->count() > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <!-- <th>Nama Tiket</th> -->
                            <th>Nama Event</th>
                            <th>Pembeli</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <!-- <td>{{ $order->ticket->name }}</td> -->
                                <td>{{ $order->ticket->event->name }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>Rp{{ number_format($order->total_price) }}</td>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye me-1"></i> Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">Belum ada pesanan.</p>
            @endif
        </div>

        <h2 class="section-title mt-4"><i class="fas fa-ticket-alt me-2"></i> Tiket Tersedia</h2>

        <div class="row">
            @if($tickets->count() > 0)
                @foreach ($tickets as $ticket)
                    <div class="col-md-4 mb-3">
                        <div class="card ticket-card">
                            <div class="card-body">
                                <!-- <h5 class="card-title"><i class="fas fa-tag me-2"></i> {{ $ticket->name }}</h5> -->
                                <p class="card-text"><strong>Event:</strong> {{ $ticket->event->name }}</p>
                                <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($ticket->price) }}</p>
                                <p class="card-text"><strong>Sisa Stok:</strong>
                                    @if ($ticket->stock > 0)
                                        <span class="badge bg-success">{{ $ticket->stock }}</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </p>
                                <p class="card-text"><small>Terakhir diperbarui: {{ $ticket->updated_at->format('d M Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-data">Belum ada tiket.</p>
            @endif
        </div>

        <a href="{{ route('admin.events.index') }}" class="back-link mt-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Event
        </a>
    </div>

    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            padding: 20px;
            margin: 20px auto;
        }

        .section-title {
            color: #1e88e5;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.8em;
        }

        .table th,
        .table td {
            padding: 0.5rem; /* Kurangi padding */
            font-size: 0.9rem; /* Kurangi ukuran font */
        }

        .order-card {
            border-left: 5px solid #29b6f6;
        }

        .ticket-card {
            border-left: 5px solid #4caf50;
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
    </style>
@endsection