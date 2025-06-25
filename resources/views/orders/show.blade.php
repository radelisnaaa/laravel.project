@extends('layouts.public-app')

@section('title', 'Detail Order Anda - ' . $order->id)

@section('head_extra')
    <style>
        /* Mengatur ulang beberapa gaya agar lebih bersih dan modern */
        .container {
            max-width: 700px; /* Lebar container lebih fokus */
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .order-card {
            background-color: #ffffff;
            border-radius: 1.25rem; /* Sudut lebih melengkung */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Bayangan lebih dalam */
            padding: 40px; /* Padding internal lebih besar */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .page-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 35px;
            font-weight: 700;
            font-size: 2.2em; /* Ukuran judul lebih besar */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-title i {
            margin-right: 15px;
            font-size: 1.2em;
            color: var(--primary-color);
        }

        .order-summary {
            background-color: #f0f8ff; /* Latar belakang detail order lebih lembut */
            border-radius: 1rem;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #cfe2ff; /* Border biru muda */
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #e9ecef; /* Garis putus-putus */
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item strong {
            color: var(--dark-text);
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .order-item strong i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .order-item span {
            color: #555;
            font-weight: 500;
        }

        .total-price-section {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 30px;
            border-radius: 0.75rem;
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.3em;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .total-price-section span:first-child {
            display: flex;
            align-items: center;
        }

        .total-price-section i {
            margin-right: 10px;
        }

        .action-buttons {
            margin-top: 40px;
            text-align: center;
        }

        .action-buttons .btn {
            min-width: 200px;
            padding: 12px 25px;
            font-size: 1.1em;
            font-weight: 600;
            border-radius: 0.75rem;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Responsif */
        @media (max-width: 576px) {
            .order-card {
                padding: 20px;
            }
            .page-title {
                font-size: 1.8em;
                flex-direction: column;
            }
            .page-title i {
                margin-right: 0;
                margin-bottom: 10px;
            }
            .action-buttons .btn {
                width: 100%;
                margin-bottom: 15px;
                margin-left: 0;
                margin-right: 0;
            }
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <div class="order-card">
        <h1 class="page-title">
            <i class="fas fa-receipt"></i> Detail Pesanan #{{ $order->id }}
        </h1>

        <div class="order-summary">
            <div class="order-item">
                <strong><i class="fas fa-calendar-alt"></i> Event:</strong>
                <span>{{ $order->ticket->event->name }}</span>
            </div>
            <div class="order-item">
                <strong><i class="fas fa-ticket-alt"></i> Tiket:</strong>
                <span>{{ $order->ticket->name }}</span>
            </div>
            <div class="order-item">
                <strong><i class="fas fa-sort-numeric-up-alt"></i> Jumlah:</strong>
                <span>{{ $order->quantity }}</span>
            </div>
            <div class="order-item">
                <strong><i class="fas fa-info-circle"></i> Status Pesanan:</strong>
                {{-- Anda bisa menambahkan logika status di sini, contoh: --}}
                @php
                    $status = 'Completed'; // Ganti dengan logika status dari model $order Anda
                    $statusClass = 'text-success'; // Atur warna berdasarkan status
                    if($status == 'Pending') $statusClass = 'text-warning';
                    if($status == 'Cancelled') $statusClass = 'text-danger';
                @endphp
                <span class="{{ $statusClass }} font-weight-bold">{{ $status }}</span>
            </div>
            <div class="order-item">
                <strong><i class="fas fa-calendar-check"></i> Tanggal Pembelian:</strong>
                <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y, H:i') }} WIB</span>
            </div>
        </div>

        <div class="total-price-section">
            <span><i class="fas fa-wallet"></i> Total Pembayaran:</span>
            <span>Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>

        <div class="action-buttons">
            <a href="{{ route('user.orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list-alt me-2"></i> Lihat Semua Pesanan
            </a>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i> Kembali ke Dasbor
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts_extra')
    @endsection