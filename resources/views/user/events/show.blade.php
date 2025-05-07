@extends('layouts.admin-app')

@section('title', 'Detail Event')
@section('title-content', 'Detail Event')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary mb-2">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Event
            </a>
        </div>

        <div class="event-card">
            <h3 class="text-primary mb-3"><i class="fas fa-calendar-day me-2"></i>{{ $event->title }}</h3>

            <p><i class="fas fa-clock me-1"></i> Tanggal: {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>

            @if ($event->speaker)
                <p><i class="fas fa-user-tie me-1"></i> Pembicara: {{ $event->speaker }}</p>
            @endif

            @if ($event->tickets->count())
                <p><i class="fas fa-ticket-alt me-1"></i> Jenis Tiket: {{ $event->tickets->pluck('name')->implode(', ') }}</p>
            @endif

            <p class="mt-3">{{ $event->description }}</p>

            @if ($event->zoom_link)
                <div class="mt-4">
                    <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-success">
                        <i class="fas fa-video me-1"></i> Gabung Zoom
                    </a>
                </div>
            @endif

            <div class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        @if ($isJoined)
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-1"></i> Anda sudah terdaftar pada event ini.
                            </div>
                        @else
                            <form action="{{ route('admin.events.join', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-ticket-alt me-1"></i> Daftar Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Event
                        </a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                <i class="fas fa-trash-alt me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection