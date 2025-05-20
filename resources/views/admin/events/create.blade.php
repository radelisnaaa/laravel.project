@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <h1 class="admin-title mb-4"><i class="fas fa-plus-circle me-2"></i> Tambah Acara Baru</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-signature me-1"></i> Nama Acara</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama acara" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label"><i class="fas fa-file-alt me-1"></i> Deskripsi Acara</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Jelaskan detail acara" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="speaker" class="form-label"><i class="fas fa-microphone me-1"></i> Pembicara</label>
                            <input type="text" class="form-control @error('speaker') is-invalid @enderror" id="speaker" name="speaker" placeholder="Sebutkan nama pembicara" value="{{ old('speaker') }}" required>
                            @error('speaker')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="zoom_link" class="form-label"><i class="fas fa-link me-1"></i> Link Zoom (Opsional)</label>
                            <input type="url" class="form-control @error('zoom_link') is-invalid @enderror" id="zoom_link" name="zoom_link" placeholder="Tempelkan link Zoom jika ada" value="{{ old('zoom_link') }}">
                            @error('zoom_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date" class="form-label">
                                    <i class="fas fa-calendar-alt me-1"></i> Tanggal Acara
                                </label>
                                <input
                                    type="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    id="date"
                                    name="date"
                                    value="{{ old('date', now()->format('Y-m-d')) }}"
                                    required
                                    autocomplete="off"
                                >
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="start_time" class="form-label">
                                    <i class="fas fa-clock me-1"></i> Waktu Mulai
                                </label>
                                <input
                                    type="time"
                                    class="form-control @error('start_time') is-invalid @enderror"
                                    id="start_time"
                                    name="start_time"
                                    value="{{ old('start_time') }}"
                                    required
                                    autocomplete="off"
                                >
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">
                                <i class="fas fa-clock me-1"></i> Waktu Selesai
                            </label>
                            <input
                                type="time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                id="end_time"
                                name="end_time"
                                value="{{ old('end_time') }}"
                                required
                                autocomplete="off"
                            >
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label"><i class="fas fa-image me-1"></i> Gambar Acara</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Acara</button>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Acara</a>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-ban me-2"></i> Anda tidak memiliki akses ke halaman ini.
            </div>
        @endif
    </div>

    <style>
        .admin-title {
            color: #3490dc; /* Warna biru yang lebih menarik */
        }

        .form-label {
            font-weight: bold; /* Label lebih menonjol */
            color: #495057; /* Warna teks label standar */
        }

        .form-control {
            border-radius: 0.25rem; /* Sudut input yang lebih lembut */
            border: 1px solid #ced4da; /* Warna border standar */
        }

        .form-control:focus {
            border-color: #3490dc; /* Warna border saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25); /* Efek shadow saat fokus */
        }

        .invalid-feedback {
            color: #e3342f; /* Warna teks error */
            font-size: 0.875em;
        }

        .btn-primary {
            background-color: #3490dc; /* Warna primer */
            border-color: #3490dc;
        }

        .btn-primary:hover {
            background-color: #2779bd; /* Warna primer saat hover */
            border-color: #2779bd;
        }

        .btn-secondary {
            background-color: #6c757d; /* Warna sekunder */
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Warna sekunder saat hover */
            border-color: #5a6268;
        }

        .card {
            margin-top: 20px; /* Sedikit jarak dari judul */
            border: none; /* Hilangkan border default card */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Efek shadow pada card */
            border-radius: 0.5rem; /* Sudut card yang lebih membulat */
        }

        .card-body {
            padding: 2rem; /* Padding di dalam card */
        }

        .alert-danger {
            border-radius: 0.25rem;
        }
    </style>
@endsection