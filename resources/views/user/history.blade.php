@extends('layouts.user-app')

@section('title', 'Riwayat Pemesanan Saya')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Riwayat Pemesanan Tiket</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info shadow-sm">
            <i class="fas fa-info-circle me-2"></i> Kamu belum pernah melakukan pemesanan.
        </div>
    @else
        <ul class="list-group shadow-sm">
            @foreach($orders->sortByDesc('created_at') as $order)
                <li class="list-group-item" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#orderDetails-{{ $order->id }}" aria-expanded="false" aria-controls="orderDetails-{{ $order->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Pesanan #{{ $order->id }}</h6>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <div>
                            <span class="badge rounded-pill text-white bg-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                <i class="fas fa-circle me-1"></i> {{ ucfirst($order->status) }}
                            </span>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </div>
                    </div>
                </li>
                <li class="collapse" id="orderDetails-{{ $order->id }}">
                    <div class="card card-body bg-light">
                        <h6 class="card-title">Detail Pemesanan #{{ $order->id }}</h6>
                        <p class="card-text"><i class="fas fa-ticket-alt me-1"></i> Event: {{ $order->ticket->event->title ?? '-' }}</p>
                        <p class="card-text"><i class="fas fa-users me-1"></i> Jumlah Tiket: {{ $order->quantity }}</p>
                        <p class="card-text"><i class="fas fa-coins me-1"></i> Total Harga: Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                        @if($order->updated_at && $order->created_at->ne($order->updated_at))
                            <p class="card-text small text-muted">Terakhir Diperbarui: {{ $order->updated_at->format('l, d F Y, H:i') }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection