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
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Pesanan #{{ $order->id }}</h6>
                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> {{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <div>
                            <span class="badge rounded-pill text-white bg-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">
                                <i class="fas fa-circle me-1"></i> {{ ucfirst($order->status) }}
                            </span>
                            <!-- Tombol toggle untuk detail -->
                            <button class="btn btn-sm btn-outline-primary ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#orderDetails-{{ $order->id }}" aria-expanded="false" aria-controls="orderDetails-{{ $order->id }}">
                                Detail
                            </button>
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

                        {{-- Tombol bayar, muncul kalau statusnya pending --}}
                        @if($order->status === 'pending')
                            <a href="{{ route('user.orders.pay', $order->id) }}" class="btn btn-success mt-3">
                                Bayar Sekarang
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
