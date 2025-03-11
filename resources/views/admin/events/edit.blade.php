<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #81D4FA;
        }

        .container {
            max-width: 600px;
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
    <h1 class="text-center mb-4 text-primary">Edit Acara</h1>

    @if (Auth::check() && Auth::user()->role === 'admin')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-lg p-4">
            <div class="card-body">
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Acara</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $event->name) }}" placeholder="Masukkan Nama Acara" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pembicara</label>
                        <input type="text" class="form-control @error('speaker') is-invalid @enderror" name="speaker" value="{{ old('speaker', $event->speaker) }}" placeholder="Masukkan Pembicara" required>
                        @error('speaker')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Acara</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Deskripsi Acara" rows="3" required>{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Acara</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $event->date) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Acara</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">SIMPAN PERUBAHAN</button>
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p class="text-center mt-3 text-danger">Anda tidak memiliki akses ke halaman ini.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>