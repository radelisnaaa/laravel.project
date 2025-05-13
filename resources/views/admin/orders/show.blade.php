@extends('layouts.admin-app')

@section('title', 'Detail Order')

@section('title-content')
    Detail Order #{{ $order->id }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Order</h6>
                </div>
                <div class="card-body">
                    <p><strong>ID Order:</strong> {{ $order->id }}</p>
                    <p><strong>Event:</strong> {{ $order->ticket->event->name }}</p>
                    <p><strong>Tiket:</strong> {{ $order->ticket->name }} (ID: {{ $order->ticket->id }})</p>
                    <p><strong>Pembeli:</strong> {{ $order->user->name }} (ID: {{ $order->user->id }})</p>
                    <p><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                    <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_price) }}</p>
                    <p><strong>Tanggal Pembelian:</strong> {{ $order->created_at->format('d F Y, H:i:s') }}</p>

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-header .font-weight-bold {
            font-size: 1.1rem;
        }
        .card-body p strong {
            font-weight: 500;
        }
    </style>
@endpush