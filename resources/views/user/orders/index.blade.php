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
                            <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary ms-3">
                                Detail
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
