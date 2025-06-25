@extends('layouts.public-app')

@section('title', 'Detail Acara - ' . $event->name)

@section('head_extra')
    <style>
        .container {
            max-width: 1000px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 300px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #222;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .btn {
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.02);
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #17a2b8);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0062cc, #138496);
        }

        .btn-outline-primary {
            border-color: #17a2b8;
            color: #17a2b8;
        }

        .btn-outline-primary:hover {
            background-color: #17a2b8;
            color: white;
        }

        .ticket {
            background: #fdfdfd;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .ticket h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #007bff;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #eee;
        }

        .zoom-link {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .card-img-top {
                height: 200px;
            }

            .card-body {
                padding: 20px;
            }

            .card-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <div class="card mx-auto">
        @if($event->image && file_exists(public_path('storage/' . $event->image)))
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="Gambar Acara">
        @else
            <img src="https://via.placeholder.com/900x300?text=Gambar+Acara+Tidak+Tersedia" class="card-img-top" alt="Gambar Placeholder">
        @endif

        <div class="card-body">
            <h2 class="card-title">{{ $event->name }}</h2>
            <p class="card-text"><i class="fas fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
            <p class="card-text"><i class="fas fa-user me-2"></i> Pembicara: {{ $event->speaker }}</p>
            <p class="card-text"><i class="fas fa-info-circle me-2"></i> {{ $event->description }}</p>

            @if (!empty($event->zoom_link))
                <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-primary zoom-link">
                    <i class="fas fa-video"></i> Gabung Zoom Meeting
                </a>
            @else
                <button class="btn btn-secondary disabled zoom-link" aria-disabled="true">
                    <i class="fas fa-video"></i> Zoom (Belum Tersedia)
                </button>
            @endif

            <h4 class="mt-5">Tiket Tersedia</h4>
            @if ($event->tickets->count() > 0)
                @foreach ($event->tickets as $ticket)
                    <div class="ticket">
                        <h4>{{ $ticket->name }}</h4>
                        <p>Harga: <strong>Rp{{ number_format($ticket->price, 0, ',', '.') }}</strong></p>
                        <p>Kuota: {{ $ticket->quota }}</p>

                        @auth
                            @php
                                $userOrder = auth()->user()->orders()
                                    ->where('ticket_id', $ticket->id)
                                    ->where('event_id', $event->id)
                                    ->first();
                            @endphp

                            @if($userOrder)
                                <p class="text-success"><i class="fas fa-check-circle me-2"></i> Anda sudah membeli tiket ini (Order ID: {{ $userOrder->id }})</p>
                                <a href="{{ route('orders.user.show', $userOrder->id) }}" class="btn btn-info btn-sm">Lihat Order</a>
                            @else
                                <form action="{{ route('orders.user.store') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <div class="mb-3">
                                        <label for="quantity-{{ $ticket->id }}" class="form-label">Jumlah Tiket:</label>
                                        <input type="number" id="quantity-{{ $ticket->id }}" name="quantity" class="form-control" min="1" max="{{ $ticket->quota }}" value="1" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Beli Tiket</button>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-warning mt-3" role="alert">
                                Silakan <a href="{{ route('login') }}" class="alert-link">masuk</a> untuk membeli tiket.
                            </div>
                        @endauth
                    </div>
                @endforeach
            @else
                <p class="text-muted">Tidak ada tiket tersedia untuk event ini.</p>
            @endif

            <h4 class="mt-5">Peserta Event</h4>
            @if($event->users->count() > 0)
                <ul class="list-group">
                    @foreach ($event->users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $user->name }}
                            <span class="badge bg-primary">Bergabung</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Belum ada peserta untuk event ini.</p>
            @endif

            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Event
                </a>
                @auth
                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home me-2"></i> Kembali ke Dasbor Saya
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts_extra')
{{-- Tambahkan JavaScript khusus di sini jika diperlukan --}}
@endsection
