@extends('layouts.user-app')

@section('title', 'Detail Order')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="fas fa-receipt me-2 text-primary"></i>Detail Order
    </h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Info Order -->
                <div class="col-md-6">
                    <h5 class="fw-semibold mb-3">
                        <i class="fas fa-ticket-alt me-2 text-primary"></i>Informasi Order
                    </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Event:</strong></span>
                            <span class="text-primary">{{ $order->ticket->event->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Tiket:</strong></span>
                            <span class="text-primary">{{ $order->ticket->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Jumlah:</strong></span>
                            <span class="text-info">{{ $order->quantity }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Total:</strong></span>
                           <span class="text-success">Rp{{ number_format($order->total_price * 1000, 0, ',', '.') }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><strong>Status:</strong></span>
                            <span class="badge rounded-pill px-3 py-2 bg-{{ 
                                $order->status === 'paid' ? 'success' : 
                                ($order->status === 'pending' ? 'warning text-dark' : 'danger') }}">
                                <i class="fas fa-{{ 
                                    $order->status === 'paid' ? 'check-circle' : 
                                    ($order->status === 'pending' ? 'hourglass-half' : 'times-circle') }} me-1"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="col-md-6 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <a href="{{ route('user.orders.index') }}" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali ke daftar order">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        @if ($order->status === 'pending')
                            <a href="{{ route('user.orders.pay', $order->id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar tiket sekarang">
                                <i class="fas fa-money-bill me-1"></i> Bayar Sekarang
                            </a>
                        @endif
                    </div>
                    <div class="alert alert-warning mt-4 small mb-0" role="alert">
                        <i class="fas fa-exclamation-triangle me-1 text-warning"></i>
                        <strong>Catatan:</strong> Harap segera melakukan pembayaran jika status pesanan Anda adalah <em>"Pending"</em>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tooltip init -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush
@endsection
