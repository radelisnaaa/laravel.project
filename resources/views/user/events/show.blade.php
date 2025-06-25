@extends('layouts.user-app')

@section('title', 'Detail Event')
@section('title-content', 'Detail Event')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('user.events.index') }}" class="btn btn-outline-secondary mb-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Event
        </a>
    </div>

    <div class="event-card">
        <h3 class="text-primary mb-3"><i class="fas fa-calendar-day me-2"></i>{{ $event->title }}</h3>

        <p><i class="fas fa-clock me-1"></i> Tanggal: {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>

        @if ($event->speaker)
            <p><i class="fas fa-user-tie me-1"></i> Pembicara: {{ $event->speaker }}</p>
        @endif

        @if ($event->tickets->count())
            <p><i class="fas fa-ticket-alt me-1"></i> Jenis Tiket: {{ $event->tickets->pluck('name')->implode(', ') }}</p>
        @endif

        <p class="mt-3">{{ $event->description }}</p>

        @if ($event->zoom_link && $isJoined)
            <div class="mt-4">
                <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-success">
                    <i class="fas fa-video me-1"></i> Gabung Zoom
                </a>
            </div>
        @endif

        <div class="mt-4">
            @if ($isJoined)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-1"></i> Anda sudah terdaftar pada event ini.
                </div>
            @else
                <h5 class="mb-3">Pilih Tiket dan Beli:</h5>
                <form action="{{ route('user.orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <div class="mb-3">
                        <label class="form-label">Pilih Tiket dan Jumlah:</label>
                        @foreach($event->tickets as $ticket)
                            <div class="card mb-2 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $ticket->name }}</strong><br>
                                        Harga: Rp{{ number_format($ticket->price, 0, ',', '.') }}
                                    </div>
                                    <div style="width: 100px;">
                                        <input type="number" name="tickets[{{ $ticket->id }}]" class="form-control" min="0" value="0">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah Tiket</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1" required>
                    </div>
<button type="submit" class="btn btn-warning">
    <i class="fas fa-ticket-alt me-1"></i> Beli Tiket
</button>

                </form>
            @endif
        </div>
    </div>
</div>
@endsection