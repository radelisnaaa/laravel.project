@extends('layouts.user-app')

@section('title', 'E-Ticket')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">E-Ticket</h2>

    <div class="card shadow-sm p-4">
        <div class="mb-3">
            <strong>Nama Event:</strong> {{ $order->ticket->event->name }}
        </div>

        <div class="mb-3">
            <strong>Deskripsi Event:</strong>
            <p>{{ $order->ticket->event->description ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <strong>Nama Tiket:</strong> {{ $order->ticket->name }}
        </div>

        <div class="mb-3">
            <strong>Jumlah Tiket:</strong> {{ $order->quantity }}
        </div>

        <div class="mb-3">
            <strong>Total Harga:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}
        </div>

        <div class="mb-3">
            <strong>Status Pembayaran:</strong>
            <span class="badge bg-{{ 
                $order->status == 'pending' ? 'warning' : 
                ($order->status == 'paid' ? 'success' : 'secondary') }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="mb-3">
            <strong>ID Pemesanan:</strong> ORDER-{{ $order->id }}
        </div>

        {{-- Tambahkan QR Code jika ingin --}}
        {{-- <div class="mb-3">
            {!! QrCode::size(150)->generate('ORDER-' . $order->id) !!}
        </div> --}}

        <div class="mt-4">
            <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Kembali ke Daftar Tiket</a>
        </div>
    </div>
</div>
@endsection
