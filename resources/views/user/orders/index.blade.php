@extends('layouts.user-app')

@section('title', 'Riwayat Pemesanan Saya')

@section('head')
<style>
    /* Custom styles for the order history page */
    .order-card {
        background-color: var(--content-bg);
        border-radius: 0.75rem; /* Consistent with other cards */
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); /* Subtle shadow */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        margin-bottom: 1rem; /* Spacing between cards */
        border: 1px solid rgba(0, 0, 0, 0.08); /* Light border */
        overflow: hidden; /* Ensures inner elements respect border-radius */
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
    }

    .order-card-header {
        background-color: var(--active-bg); /* Lighter blue for header */
        color: var(--active-text); /* Darker blue text */
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Allow wrapping on small screens */
        gap: 0.5rem; /* Space between elements */
    }

    .order-card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column; /* Stack details vertically on small screens */
    }

    .order-details-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .order-status-badge {
        font-size: 0.9em;
        padding: 0.4em 0.8em;
        border-radius: 50rem; /* Pill shape */
        font-weight: 600;
        min-width: 80px; /* Ensure consistent width */
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Custom badge colors from layout palette */
    .badge-paid {
        background-color: var(--accent-green) !important;
        color: var(--sidebar-text) !important;
    }
    .badge-pending {
        background-color: #ffc107 !important; /* Bootstrap warning yellow */
        color: #212529 !important; /* Dark text for warning */
    }
    .badge-cancelled {
        background-color: #dc3545 !important; /* Bootstrap danger red */
        color: var(--sidebar-text) !important;
    }

    .btn-payment {
        background-color: var(--sidebar-bg); /* Primary blue for payment button */
        border-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn-payment:hover {
        background-color: var(--sidebar-hover);
        border-color: var(--sidebar-hover);
        color: var(--sidebar-text);
        transform: translateY(-2px);
    }

    .btn-payment .fas {
        margin-right: 0.5rem;
    }

    /* Responsive adjustments */
    @media (min-width: 768px) {
        .order-card-body {
            flex-direction: row; /* Details side-by-side on larger screens */
            justify-content: space-between;
            align-items: center;
        }
        .order-details-group {
            flex-direction: row; /* Icons and text inline */
            gap: 1.5rem;
        }
        .order-action-area {
            text-align: right;
        }
    }

    .alert-custom-info {
        background-color: #d1ecf1; /* Light blue from layout */
        color: #0c5460; /* Dark blue text */
        border-color: #bee5eb;
        border-radius: 0.5rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .alert-custom-info i {
        font-size: 1.5rem;
        margin-right: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <h2 class="mb-4 text-primary d-flex align-items-center">
                <i class="fas fa-history me-2"></i> Riwayat Pemesanan Tiket
            </h2>

            @if($orders->isEmpty())
                <div class="alert alert-custom-info">
                    <i class="fas fa-info-circle"></i> Kamu belum pernah melakukan pemesanan tiket. Ayo mulai jelajahi event menarik!
                </div>
            @else
                @foreach($orders->sortByDesc('created_at') as $order)
                    <div class="order-card">
                        <div class="order-card-header">
                            <h6 class="mb-0 fw-bold">Pesanan #{{ $order->id }}</h6>
                            <small class="text-muted text-nowrap">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $order->created_at->format('d M Y, H:i') }} WIB
                            </small>
                        </div>
                        <div class="order-card-body">
                            <div class="order-details-group">
                                <p class="mb-0">
                                    <i class="fas fa-ticket-alt me-2 text-info"></i>
                                    <span class="fw-bold">Event:</span> {{ $order->ticket->event->name ?? 'N/A' }}
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-tag me-2 text-warning"></i>
                                    <span class="fw-bold">Jenis Tiket:</span> {{ $order->ticket->name ?? 'N/A' }}
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-rupiah-sign me-2 text-success"></i>
                                    <span class="fw-bold">Total Pembayaran:</span> Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="order-action-area mt-3 mt-md-0 d-flex flex-column align-items-end">
                                <span class="order-status-badge mb-2
                                    @if($order->status === 'paid') badge-paid
                                    @elseif($order->status === 'pending') badge-pending
                                    @else badge-cancelled @endif">
                                    <i class="fas fa-circle me-1"></i> {{ ucfirst($order->status) }}
                                </span>

                                @if($order->status === 'pending')
                                    <a href="{{ route('user.orders.payment', ['id' => $order->id]) }}" class="btn btn-payment btn-sm w-100 w-md-auto">
                                        <i class="fas fa-money-bill-wave"></i> Lanjutkan Pembayaran
                                    </a>
                                @elseif($order->status === 'paid')
                                    <a href="{{ route('user.tickets.show', $order->id) }}" class="btn btn-outline-success btn-sm w-100 w-md-auto">
                                        <i class="fas fa-receipt"></i> Lihat E-Tiket
                                    </a>v 
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection