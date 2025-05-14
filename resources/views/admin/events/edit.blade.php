@extends('layouts.admin-app')

@section('title', 'Edit Event')

@section('title-content')
    <i class="fas fa-pencil-alt me-2"></i> Edit Event
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::check() && Auth::user()->role === 'admin')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> Ada kesalahan dalam pengisian formulir:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-lg">
                    <div class="card-body">
                        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold"><i class="fas fa-signature me-2"></i> Nama Acara</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" placeholder="Masukkan Nama Acara" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="speaker" class="form-label fw-bold"><i class="fas fa-microphone me-2"></i> Pembicara</label>
                                <input type="text" class="form-control @error('speaker') is-invalid @enderror" id="speaker" name="speaker" value="{{ old('speaker', $event->speaker) }}" placeholder="Masukkan Pembicara" required>
                                @error('speaker')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold"><i class="fas fa-file-alt me-2"></i> Deskripsi Acara</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Deskripsi Acara" rows="3" required>{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label fw-bold"><i class="fas fa-calendar-alt me-2"></i> Tanggal Acara</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $event->date) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="zoom_link" class="form-label fw-bold">
                                    <i class="fas fa-video me-2"></i> Link Zoom
                                </label>
                                <input
                                    type="url"
                                    class="form-control @error('zoom_link') is-invalid @enderror"
                                    id="zoom_link"
                                    name="zoom_link"
                                    value="{{ old('zoom_link', $event->zoom_link) }}"
                                    placeholder="https://zoom.us/..."
                                    required
                                >
                                @error('zoom_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold"><i class="fas fa-image me-2"></i> Gambar Acara</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100" class="mt-2 rounded">
                                @endif
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN</button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> KEMBALI</a>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i> Anda tidak memiliki akses ke halaman ini.
                </div>
            @endif
        </div>
    </div>
@endsection

