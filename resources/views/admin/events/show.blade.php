@extends('layouts.admin-app')

@section('content')
    <div class="container">
        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="header-card">
                <h1 class="header-title"><i class="fas fa-info-circle me-2"></i> Detail Acara</h1>
            </div>

            <div class="event-details-card">
                <div class="event-image-container">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-image img-fluid">
                </div>

                <div class="detail-item">
                    <i class="fas fa-signature"></i> <strong>Nama:</strong> {{ $event->name }}
                </div>
                <div class="detail-item">
                    <i class="fas fa-microphone"></i> <strong>Pembicara:</strong> {{ $event->speaker }}
                </div>
                <div class="detail-item">
                    <i class="fas fa-calendar-alt"></i> <strong>Tanggal:</strong> {{ $event->date }}
                </div>
                <div class="detail-item">
                    <i class="fas fa-scroll"></i> <strong>Deskripsi:</strong> {{ $event->description }}
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali</a>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt me-2"></i> Edit</a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus acara ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt me-2"></i> Hapus</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Tidak ada akses.</p>
        @endif
    </div>

    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 0; /* Remove body padding as container has its own */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            width: 100%;
            margin-top: 20px; /* Add some top margin if needed */
            margin-bottom: 20px; /* Add some bottom margin if needed */
            padding: 30px; /* Add padding to the container */
        }
        .header-card {
            background-color: #2196f3;
            color: white;
            padding: 25px;
            border-radius: 12px 12px 0 0;
            text-align: center;
            margin-bottom: 20px;
        }
        .header-title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .event-details-card {
            padding: 25px;
        }
        .event-image-container {
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .event-image {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
            max-height: 250px;
            object-fit: cover;
        }
        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #555;
            font-size: 1em;
        }
        .detail-item i {
            margin-right: 15px;
            color: #2196f3;
            font-size: 1.2em;
            width: 25px;
            text-align: center;
        }
        .detail-item strong {
            color: #333;
            font-weight: bold;
            margin-right: 8px;
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .btn-secondary, .btn-primary, .btn-danger {
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 0.9em;
            border: none;
            flex-grow: 1;
            text-align: center;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }
        .btn-primary {
            background-color: #1e88e5;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }
        .btn-danger {
            background-color: #e53935;
        }
        .btn-danger:hover {
            background-color: #c62828;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }
        .text-danger {
            color: #d32f2f !important;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            font-size: 1em;
        }
    </style>
@endsection