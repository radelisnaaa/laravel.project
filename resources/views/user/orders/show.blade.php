<!-- @extends('layouts.user-app')

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
                    </ul> <!-- ✅ PENUTUP UL DITAMBAHKAN DI SINI -->
                </div>

                <!-- Actions -->
                <div class="col-md-6 d-flex flex-column justify-content-end align-items-end">
                    <div class="d-flex gap-2 mt-4 mt-md-0">
                        <a href="{{ route('user.orders.index') }}"
                           class="btn btn-outline-secondary btn-sm"
                           data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="Kembali ke daftar order">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        @if ($order->status === 'pending')
                            <button type="button"
                                    class="btn btn-success btn-sm"
                                    id="pay-button"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Bayar tiket sekarang">
                                <i class="fas fa-money-bill me-1"></i> Bayar Sekarang
                            </button>
                        @endif
                    </div>
                </div>
            </div> <!-- row -->
        </div>
    </div>
</div>

<!-- Tooltip & Snap.js -->
@push('scripts')
<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.querySelectorAll('.pay-button').forEach(function(button) {
        button.addEventListener('click', function () {
            var snapToken = this.dataset.snapToken;
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Payment Successful!");
                    location.reload();
                },
                onPending: function(result) {
                    alert("Waiting for payment...");
                },
                onError: function(result) {
                    alert("Payment failed. Please try again.");
                },
                onClose: function() {
                    alert("Payment popup closed.");
                }
            });
        });
    });
</script>
@endpush

@endsection -->
