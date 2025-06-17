@extends('layouts.user-app')

@section('title', 'Detail E-Tiket Anda')

@section('head')
<style>
    /* Custom styles for the ticket detail page */
    .ticket-card {
        background-color: var(--content-bg);
        border-radius: 0.75rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1); /* Stronger shadow for main content */
        overflow: hidden;
        margin-bottom: 2rem;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .ticket-header {
        background-image: linear-gradient(to right, var(--sidebar-bg), var(--sidebar-hover));
        color: var(--sidebar-text);
        padding: 1.5rem 2rem;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        text-align: center;
    }

    .ticket-header h4 {
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
    }

    .ticket-header p {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .ticket-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .qr-code-section {
        border: 2px dashed var(--active-bg);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        background-color: #f8f9fa; /* Light background for QR code area */
    }

    .qr-code-section img {
        display: block;
        max-width: 200px; /* Limit QR code size */
        height: auto;
        margin: 0 auto;
        padding: 0.5rem; /* Inner padding for QR code */
        background-color: white; /* Ensure QR code has white background */
        border-radius: 0.25rem;
    }

    .ticket-details-grid {
        display: grid;
        grid-template-columns: 1fr; /* Single column on mobile */
        gap: 1rem;
        width: 100%;
        max-width: 600px; /* Limit width for details */
        margin-bottom: 2rem;
    }

    .ticket-details-grid .detail-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.05rem;
        color: var(--text-primary);
        padding: 0.75rem 1rem;
        background-color: var(--body-bg); /* Use body background for detail items */
        border-radius: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        text-align: left; /* Align text left within item */
    }

    .ticket-details-grid .detail-item i {
        color: var(--sidebar-bg); /* Icon color from sidebar */
        font-size: 1.2em;
    }

    .ticket-details-grid .detail-item strong {
        color: var(--brand-color); /* Stronger color for labels */
        min-width: 120px; /* Align labels */
    }

    .event-info-section {
        background-color: #f0f8ff; /* Very light blue background */
        padding: 1.5rem;
        border-radius: 0.75rem;
        width: 100%;
        text-align: left;
        box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .event-info-section h5 {
        color: var(--brand-color);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .event-info-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .event-info-section ul li {
        margin-bottom: 0.7rem;
        color: var(--text-primary);
        font-size: 1.05rem;
        display: flex;
        align-items: flex-start;
    }

    .event-info-section ul li i {
        color: var(--active-text);
        margin-right: 0.8rem;
        font-size: 1.1em;
        width: 20px; /* Fixed width for icons */
        flex-shrink: 0;
    }

    /* Print Button */
    .btn-print-ticket {
        background-color: var(--accent-green);
        border-color: var(--accent-green);
        color: var(--sidebar-text);
        font-weight: 600;
        padding: 0.8rem 1.8rem;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        margin-top: 2rem;
    }

    .btn-print-ticket:hover {
        background-color: #218838; /* Slightly darker green */
        border-color: #1e7e34;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    /* Responsive adjustments */
    @media (min-width: 768px) {
        .ticket-body {
            flex-direction: row; /* Layout side-by-side on desktop */
            justify-content: center;
            align-items: flex-start; /* Align items to the top */
            gap: 2rem;
        }

        .qr-code-section {
            flex-shrink: 0; /* Don't shrink QR code */
            margin-bottom: 0; /* No bottom margin when side-by-side */
        }

        .ticket-details-and-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align details left */
            width: 100%;
            max-width: 500px; /* Adjust max width for these sections */
        }

        .ticket-details-grid {
            grid-template-columns: repeat(2, 1fr); /* Two columns on desktop */
            gap: 1.5rem; /* More space between items */
        }
        .ticket-details-grid .detail-item {
            display: block; /* Allow label and value to stack */
            text-align: center;
            padding: 1rem;
        }
        .ticket-details-grid .detail-item i {
            display: block; /* Icon on its own line */
            margin-bottom: 0.5rem;
            margin-right: 0; /* Remove right margin */
        }
        .ticket-details-grid .detail-item strong {
             display: block;
             min-width: unset; /* Remove fixed width */
             margin-bottom: 0.2rem;
        }
        .ticket-details-grid .detail-item span {
            display: block; /* Value on its own line */
        }

        .event-info-section {
            margin-top: 2rem; /* Space below details grid */
        }
    }

    /* Print Styles */
    @media print {
        body {
            padding: 0 !important; /* Remove sidebar padding */
            background-color: white !important;
            -webkit-print-color-adjust: exact; /* For backgrounds */
            print-color-adjust: exact;
        }
        .navbar-top, .sidebar, .toggle-sidebar-btn, footer, .btn-print-ticket, .container > .row:first-child { /* Hide unwanted elements */
            display: none !important;
        }
        .content-area {
            padding: 0 !important;
            margin: 0 !important;
        }
        .ticket-card {
            box-shadow: none !important;
            border: 1px solid #ccc !important;
            width: 100%;
            max-width: 100%;
            border-radius: 0;
        }
        .ticket-header {
            background-image: linear-gradient(to right, #1e88e5, #1565c0) !important; /* Force colors for print */
            color: white !important;
            padding: 1rem !important;
            border-radius: 0 !important;
        }
        .ticket-body {
            padding: 1rem !important;
            flex-direction: column !important; /* Stack vertically for print */
        }
        .qr-code-section {
            border: 1px solid #ccc !important;
            padding: 0.5rem !important;
            margin-bottom: 1rem !important;
        }
        .qr-code-section img {
            max-width: 150px !important; /* Smaller QR for print */
        }
        .ticket-details-grid, .event-info-section {
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            background-color: white !important;
            padding: 0 !important;
        }
        .ticket-details-grid .detail-item {
            border: none !important;
            background-color: white !important;
            padding: 0.5rem 0 !important;
            text-align: left !important;
            display: flex !important; /* Back to flex for print */
            align-items: center !important;
            gap: 0.5rem !important;
        }
        .ticket-details-grid .detail-item strong,
        .ticket-details-grid .detail-item span {
            display: inline !important; /* Inline for print */
        }
        .event-info-section ul li {
            margin-bottom: 0.5rem !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <h2 class="mb-4 text-primary d-flex align-items-center">
                <i class="fas fa-ticket-alt me-2"></i> Detail E-Tiket Anda
            </h2>

            @if($ticket) {{-- Assuming $ticket variable is passed to the view --}}
                <div class="ticket-card">
                    <div class="ticket-header">
                        <h4>{{ $ticket->ticketType->event->name ?? 'Nama Event Tidak Tersedia' }}</h4>
                        <p>{{ $ticket->ticketType->name ?? 'Jenis Tiket Tidak Tersedia' }}</p>
                    </div>
                    <div class="ticket-body">
                        <div class="qr-code-section">
                            {{-- Placeholder for QR Code. You'll need to generate this server-side or client-side. --}}
                            {{-- For example, using a library like Simple QR Code (Laravel): --}}
                            {{-- <img src="{{ \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($ticket->uuid) }}" alt="QR Code Tiket"> --}}
                            {{-- Or just a static placeholder for now: --}}
                            <img src="https://via.placeholder.com/200?text=QR+Code+Here" alt="QR Code Tiket">
                            <small class="text-muted mt-2 d-block">Scan QR code ini untuk verifikasi.</small>
                        </div>

                        <div class="ticket-details-and-info">
                            <div class="ticket-details-grid">
                                <div class="detail-item">
                                    <i class="fas fa-user"></i>
                                    <strong>Pemilik:</strong>
                                    <span>{{ $ticket->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-barcode"></i>
                                    <strong>Kode Tiket:</strong>
                                    <span>{{ $ticket->uuid }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <strong>Tanggal Beli:</strong>
                                    <span>{{ $ticket->created_at->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-check-circle"></i>
                                    <strong>Status:</strong>
                                    <span class="fw-bold
                                        @if($ticket->status === 'active') text-success
                                        @elseif($ticket->status === 'used') text-warning
                                        @else text-danger @endif">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-rupiah-sign"></i>
                                    <strong>Harga Tiket:</strong>
                                    <span>Rp{{ number_format($ticket->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <strong>Status Pembayaran:</strong>
                                    <span class="fw-bold
                                        @if($ticket->order->status === 'paid') text-success
                                        @elseif($ticket->order->status === 'pending') text-warning
                                        @else text-danger @endif">
                                        {{ ucfirst($ticket->order->status ?? 'N/A') }}
                                    </span>
                                </div>
                            </div>

                            <div class="event-info-section mt-4">
                                <h5><i class="fas fa-info-circle me-2"></i> Informasi Event</h5>
                                <ul>
                                    <li>
                                        <i class="fas fa-calendar-day"></i>
                                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($ticket->ticketType->event->date)->format('d F Y') ?? 'N/A' }}
                                    </li>
                                    <li>
                                        <i class="fas fa-clock"></i>
                                        <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($ticket->ticketType->event->time)->format('H:i') }} WIB - Selesai
                                    </li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <strong>Lokasi:</strong> {{ $ticket->ticketType->event->location ?? 'N/A' }}
                                    </li>
                                    <li>
                                        <i class="fas fa-file-alt"></i>
                                        <strong>Deskripsi:</strong> {{ Str::limit($ticket->ticketType->event->description ?? 'N/A', 100) }}
                                        <a href="{{ route('events.show', $ticket->ticketType->event->id ?? '#') }}" class="text-primary ms-2 small">Selengkapnya</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-print-ticket" onclick="window.print()">
                        <i class="fas fa-print me-2"></i> Cetak E-Tiket
                    </button>
                </div>

            @else
                <div class="alert alert-warning text-center shadow-sm">
                    <i class="fas fa-exclamation-triangle me-2"></i> Tiket tidak ditemukan atau Anda tidak memiliki akses.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- If you use a client-side QR code generator (e.g., qrcode.js), include it here --}}
{{-- Example: <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script> --}}
{{-- And then in a script tag:
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var qrcodeContainer = document.getElementById('qrcode');
        if (qrcodeContainer && "{{ $ticket->uuid ?? '' }}") {
            new QRCode(qrcodeContainer, {
                text: "{{ $ticket->uuid }}",
                width: 200,
                height: 200,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        }
    });
</script>
--}}
@endpush