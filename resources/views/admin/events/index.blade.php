<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd;
        }

        .container {
            max-width: 900px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin - Daftar Acara</h1>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (Auth::check() && Auth::user()->role === 'admin')
        <div class="row">
            @forelse ($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ Storage::url('images/' . $event->image) }}" class="card-img-top" alt="Gambar Acara">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                Tidak ada acara.
            </div>
            @endforelse
        </div>

        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Acara Baru
            </a>
        </div>
        @else
        <p class="text-center mt-3">Anda tidak memiliki akses ke halaman ini.</p>
        @endif
    </div>
</body>

</html>
