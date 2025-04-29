<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background-color: #e0f7fa; padding: 30px;">
<div class="container bg-white p-4 rounded shadow">
    <div class="mb-4">
        <a href="{{ route('user.events.index') }}" class="btn btn-outline-secondary mb-2">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Event Saya
        </a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary mb-2">
            <i class="fas fa-home me-1"></i> Kembali ke Dashboard
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

        @if ($event->isOngoing())
            <div class="mt-4">
                <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-success">
                    <i class="fas fa-video me-1"></i> Gabung Zoom
                </a>
            </div>
        @elseif ($event->isFinished())
            <div class="alert alert-secondary mt-3">
                <i class="fas fa-check-circle me-1"></i> Event ini telah selesai.
            </div>
        @endif

        @if ($isJoined)
            <div class="mt-4 text-success">
                <i class="fas fa-check-circle me-1"></i> Anda sudah mendaftar pada event ini.
            </div>
        @else
            <div class="mt-4">
                <a href="#" class="btn btn-warning">
                    <i class="fas fa-ticket-alt me-1"></i> Daftar Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
