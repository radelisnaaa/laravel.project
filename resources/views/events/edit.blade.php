<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Acara</title>
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
    <h1 class="text-center mb-4 text-primary">Edit Acara</h1>

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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $event->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Pembicara</label>
                    <input type="text" class="form-control @error('speaker') is-invalid @enderror" name="speaker" value="{{ old('speaker', $event->speaker) }}" required>
                    @error('speaker')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Acara</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Acara</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', $event->date) }}" required>
                    @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Acara</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">KEMBALI</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
