<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Detail Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #81D4FA;
        }

        .container {
            max-width: 800px;
        }

        .card {
            border-radius: 15px;
            background-color: rgb(169, 217, 243);
        }

        .btn-primary {
            background-color: rgb(103, 196, 240);
            border-color: #2962FF;
        }

        .btn-primary:hover {
            background-color: rgb(29, 138, 206);
            border-color: #2957E4;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Detail Acara</h1>

    @if (Auth::check() && Auth::user()->role === 'admin')
        <div class="card shadow-lg p-4">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="img-fluid" style="max-height: 300px;">
                </div>

                <h2 class="card-title">{{ $event->name }}</h2>
                <p class="card-text"><strong>Pembicara:</strong> {{ $event->speaker }}</p>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $event->description }}</p>
                <p class="card-text"><strong>Tanggal:</strong> {{ $event->date }}</p>

                <div class="d-grid gap-2">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali ke Daftar Acara</a>
                </div>
            </div>
        </div>
    @else
        <p class="text-center mt-3 text-danger">Anda tidak memiliki akses ke halaman ini.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>