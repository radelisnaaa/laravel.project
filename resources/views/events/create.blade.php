<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* body {
            background-color: #1679AB;
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 15px;
        }
        .btn-primary {
            background-color:rgb(54, 103, 155);
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color:rgb(52, 89, 128);
            border-color:rgb(201, 211, 222);
        } */

        body {
    background-color: #81D4FA; /* Biru langit */
}

.container {
    max-width: 600px;
}

.card {
    border-radius: 15px;
    background-color:rgb(169, 217, 243); /* Putih untuk latar card */
}

.btn-primary {
    background-color:rgb(103, 196, 240); /* Biru elektrik untuk tombol */
    border-color: #2962FF;
}

.btn-primary:hover {
    background-color:rgb(29, 138, 206); /* Efek hover yang lebih gelap */
    border-color: #2957E4;
}
        h1 {
         color:rgb(244, 237, 237); /* Mengubah warna teks dalam tag <h1> menjadi merah */
        }   
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Tambah Acara Baru</h1>

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
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Acara</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Acara" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Pembicara</label>
                    <input type="text" class="form-control @error('speaker') is-invalid @enderror" name="speaker" value="{{ old('speaker') }}" placeholder="Masukkan Pembicara" required>
                    @error('speaker')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Acara</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Deskripsi Acara" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Acara</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Acara</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">KEMBALI</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
