@extends('layouts.admin-app')

@section('title', 'Detail Acara')

@section('title-content')
    <i class="fas fa-info-circle me-2"></i> Detail Acara
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::check() && Auth::user()->role === 'admin')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Detail Acara</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
                            @else
                                <div class="alert alert-secondary" role="alert">
                                    <i class="fas fa-image me-2"></i> Tidak ada gambar acara.
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <i class="fas fa-signature me-2"></i> <strong>Nama:</strong> {{ $event->name }}
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-microphone me-2"></i> <strong>Pembicara:</strong> {{ $event->speaker }}
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-calendar-alt me-2"></i> <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-scroll me-2"></i> <strong>Deskripsi:</strong> <p>{{ $event->description }}</p>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-video me-2"></i> <strong>Link Zoom:</strong>
                            @if ($event->zoom_link)
                                <a href="{{ $event->zoom_link }}" target="_blank" rel="noopener noreferrer">{{ $event->zoom_link }}</a>
                            @else
                                <span class="text-muted">Tidak ada link Zoom.</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt me-2"></i> Edit</a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus acara ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt me-2"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i> Tidak ada akses.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    {{-- Tambahkan style khusus jika diperlukan --}}
    <style>
        .detail-item strong {
            width: 120px; /* Adjust width as needed */
            display: inline-block;
        }
    </style>
@endpush

@push('scripts')
    {{-- Tambahkan script khusus jika diperlukan --}}
@endpush