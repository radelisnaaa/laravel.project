<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Detail Acara</h1>

    <div class="card shadow-lg p-4">
        <div class="card-body">
        <img src="{{ asset('/storage/event/'.$event->image) }}" class="rounded" style="width: 100%">
            <h5 class="card-title fw-bold">{{ $event->name }}</h5>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $event->description }}</p>
            <p class="card-text"><strong>Pembicara:</strong> {{ $event->speaker }}</p>
            <p class="card-text"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
            <div class="mb-3">
                <!-- <strong>Gambar Acara:</strong><br>
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Gambar Acara" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                @else
                    <p>Tidak ada gambar tersedia.</p>
                @endif
            </div> -->

            <div class="d-grid gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">KEMBALI</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>