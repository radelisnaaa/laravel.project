@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Tiket Baru</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="event_id" class="form-label">ID Event</label>
                <input type="number" name="event_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ticket_type" class="form-label">Jenis Tiket</label>
                <input type="text" name="ticket_type" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quota" class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Batal</a>
            
        </form>
    </div>
@endsection


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
    <h1 class="text-center mb-4 text-primary">Tambah Tiket Baru</h1>

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
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="event_id" class="form-label">ID Event</label>
                    <input type="number" name="event_id" class="form-control @error('event_id') is-invalid @enderror" value="{{ old('event_id') }}" required>
                    @error('event_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ticket_type" class="form-label">Jenis Tiket</label>
                    <input type="text" name="ticket_type" class="form-control @error('ticket_type') is-invalid @enderror" value="{{ old('ticket_type') }}" required>
                    @error('ticket_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quota" class="form-label">Kuota</label>
                    <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota') }}" required>
                    @error('quota')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">KEMBALI</a>
                </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
