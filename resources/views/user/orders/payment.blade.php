@extends('layouts.user-app')

@section('title', 'Pembayaran Order #' . $order->id)

@section('head')
<!-- Include Midtrans Snap JS -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<style>
    /* Styling sederhana untuk halaman pembayaran */
    .payment-container {
        background-color: var(--content-bg);
        border-radius: 0.75rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 2rem;
        text-align: center;
    }

    .payment-summary-title {
        font-weight: 700;
        color: var(--sidebar-bg);
        margin-bottom: 1.5rem;
        font-size: 1.6rem;
    }

    .payment-details-list {
        list-style: none;
        padding: 0;
        margin: 0 auto 2rem auto;
        max-width: 500px;
        text-align: left;
    }

    .payment-details-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        color: var(--text-primary);
        font-size: 1.05rem;
    }

    .payment-details-list li:last-child {
        border-bottom: none;
    }

    .payment-details-list li strong {
        color: var(--brand-color);
    }

    .total-price-highlight {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--accent-green);
        margin-top: 1.5rem;
        margin-bottom: 2rem;
        display: block;
    }

    .btn-pay-action {
        background-color: var(--accent-green);
        border-color: var(--accent-green);
        color: var(--sidebar-text);
        font-weight: 600;
        padding: 0.8rem 2.5rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        font-size: 1.1rem;
        width: 100%;
    }

    .btn-pay-action:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    /* Status badge (sama dengan riwayat pemesanan) */
    .badge-status-simple {
        font-size: 0.85em;
        padding: 0.3em 0.7em;
        border-radius: 50rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }
    .badge-paid-simple { background-color: var(--accent-green) !important; color: var(--sidebar-text) !important; }
    .badge-pending-simple { background-color: #ffc107 !important; color: #212529 !important; }
    .badge-secondary-simple { background-color: #6c757d !important; color: var(--sidebar-text) !important; }


    .alert-info-custom {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
        border-radius: 0.5rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .alert-info-custom i {
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    /* Modal styling for custom alerts (sama) */
    .custom-modal .modal-content { border-radius: 0.75rem; box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2); }
    .custom-modal .modal-header { border-bottom: none; padding: 1.5rem; justify-content: center; }
    .custom-modal .modal-body { text-align: center; padding: 1.5rem; }
    .custom-modal .modal-body i { font-size: 3.5rem; margin-bottom: 1rem; }
    .custom-modal .modal-footer { border-top: none; padding: 1rem 1.5rem; justify-content: center; }
    .custom-modal .btn-confirm { background-color: var(--sidebar-bg); border-color: var(--sidebar-bg); color: var(--sidebar-text); }
    .custom-modal .btn-confirm:hover { background-color: var(--sidebar-hover); border-color: var(--sidebar-hover); }

    @media (min-width: 768px) {
        .btn-pay-action {
            width: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">
            <h2 class="mb-4 text-primary d-flex align-items-center justify-content-center">
                <i class="fas fa-money-bill-wave me-2"></i> Konfirmasi Pembayaran
            </h2>

            <div class="payment-container">
                <div class="payment-summary-title">Ringkasan Pesanan Anda</div>

                <ul class="payment-details-list">
                    <li>
                        <span><strong>Event:</strong></span>
                        <span>{{ $order->ticket->event->name ?? 'N/A' }}</span>
                    </li>
                    <li>
                        <span><strong>Jenis Tiket:</strong></span>
                        <span>{{ $order->ticket->name ?? 'N/A' }}</span>
                    </li>
                    <li>
                        <span><strong>Jumlah Tiket:</strong></span>
                        <span>{{ $order->quantity }}</span>
                    </li>
                    <li>
                        <span><strong>Status:</strong></span>
                        <span class="badge badge-status-simple
                            @if($order->status == 'pending') badge-pending-simple
                            @elseif($order->status == 'paid') badge-paid-simple
                            @else badge-secondary-simple @endif">
                            <i class="fas fa-circle me-1"></i> {{ ucfirst($order->status) }}
                        </span>
                    </li>
                </ul>

                <span class="total-price-highlight">
                    Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}
                </span>

                @if($order->status === 'pending')
                    <button id="pay-button" class="btn btn-pay-action mt-3">
                        <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                    </button>
                @else
                    <div class="alert alert-info-custom mt-4">
                        <i class="fas fa-check-circle"></i> Order ini sudah dibayar atau dibatalkan.
                        @if($order->status === 'paid')
                            <a href="{{ route('user.tickets.show', $order->id) }}" class="btn btn-sm btn-outline-primary ms-3">Lihat E-Tiket</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentStatusModalLabel">Status Pembayaran</h5>
            </div>
            <div class="modal-body">
                <i id="modalIcon" class="mb-3"></i>
                <p id="modalMessage" class="lead"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-confirm" data-bs-dismiss="modal" id="modalConfirmButton">Oke</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($order->status === 'pending')
    @push('scripts')
        {{-- Midtrans JS --}}
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const payButton = document.getElementById('pay-button');
                const paymentStatusModal = new bootstrap.Modal(document.getElementById('paymentStatusModal'));
                const modalIcon = document.getElementById('modalIcon');
                const modalMessage = document.getElementById('modalMessage');
                const modalConfirmButton = document.getElementById('modalConfirmButton');

                if (payButton) {
                    payButton.addEventListener('click', function () {
                        window.snap.pay('{{ $snapToken }}', {
                            onSuccess: function(result){
                                showModal('success', "Pembayaran berhasil! E-Tiket Anda sedang disiapkan.");
                                modalConfirmButton.onclick = function() {
                                    window.location.href = "{{ route('user.orders.index') }}";
                                };
                            },
                            onPending: function(result){
                                showModal('info', "Pembayaran tertunda. Silakan selesaikan pembayaran Anda.");
                                modalConfirmButton.onclick = function() {
                                    window.location.href = "{{ route('user.orders.index') }}";
                                };
                            },
                            onError: function(result){
                                showModal('error', "Pembayaran gagal. Mohon coba lagi.");
                                modalConfirmButton.onclick = function() {
                                    window.location.href = "{{ route('user.orders.index') }}";
                                };
                            },
                            onClose: function(){
                                showModal('warning', "Anda menutup pop-up tanpa menyelesaikan pembayaran. Pesanan Anda masih pending.");
                                modalConfirmButton.onclick = function() {
                                    window.location.href = "{{ route('user.orders.index') }}";
                                };
                            }
                        });
                    });
                }

                function showModal(type, message) {
                    modalIcon.className = 'mb-3'; // Reset classes
                    modalMessage.textContent = message;

                    switch (type) {
                        case 'success':
                            modalIcon.classList.add('fas', 'fa-check-circle', 'text-success');
                            break;
                        case 'info':
                            modalIcon.classList.add('fas', 'fa-hourglass-half', 'text-info');
                            break;
                        case 'error':
                            modalIcon.classList.add('fas', 'fa-times-circle', 'text-danger');
                            break;
                        case 'warning':
                            modalIcon.classList.add('fas', 'fa-exclamation-triangle', 'text-warning');
                            break;
                        default:
                            modalIcon.classList.add('fas', 'fa-info-circle', 'text-secondary');
                            break;
                    }
                    paymentStatusModal.show();
                }
            });
        </script>
    @endpush
@endif
