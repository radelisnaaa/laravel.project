@extends('layouts.admin-app')

@section('title', 'Daftar Acara')
@section('title-content', 'Daftar Acara')

@push('styles')
    <style>
        .header-title {
            color: var(--text-primary);
            text-align: left;
            margin-bottom: 15px; /* Kurangi margin bawah */
            font-weight: bold;
            font-size: 1.5em; /* Perkecil ukuran font lagi */
        }
        .add-button-container {
            margin-bottom: 15px; /* Kurangi margin bawah */
            text-align: right;
        }
        .btn-primary {
            background-color: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 6px 12px; /* Perkecil padding tombol */
            border-radius: 4px; /* Perkecil border radius tombol */
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 0.9em; /* Perkecil ukuran font tombol */
        }
        .btn-primary:hover {
            background-color: var(--sidebar-hover);
            border-color: var(--sidebar-hover);
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #1b5e20;
            border: 1px solid #a5d6a7;
            border-radius: 4px; /* Perkecil border radius alert */
            padding: 8px; /* Perkecil padding alert */
            margin-bottom: 15px; /* Kurangi margin bawah */
            font-size: 0.9em; /* Perkecil ukuran font alert */
        }
        .card {
            border-radius: 6px; /* Perkecil border radius card */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Efek shadow lebih halus */
        }
        .card-body {
            padding: 1rem; /* Kurangi padding card body */
        }
        .table-dark th {
            background-color: var(--active-text);
            color: white;
            text-align: center;
            padding: 8px; /* Perkecil padding header tabel */
            font-size: 0.9em; /* Perkecil ukuran font header tabel */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        .event-img {
            width: 40px; /* Perkecil ukuran gambar */
            height: 30px; /* Perkecil ukuran gambar */
            object-fit: cover;
            border-radius: 3px; /* Perkecil border radius gambar */
            box-shadow: 0 0.5px 1px rgba(0, 0, 0, 0.1); /* Efek shadow lebih halus pada gambar */
        }
        .btn-sm {
            padding: 4px 8px; /* Perkecil padding tombol aksi */
            font-size: 0.8em; /* Perkecil ukuran font tombol aksi */
            border-radius: 4px; /* Perkecil border radius tombol aksi */
            margin-right: 3px; /* Kurangi margin kanan tombol aksi */
        }
        .btn-info {
            background-color: var(--active-bg);
            border-color: var(--active-bg);
            color: var(--active-text);
        }
        .btn-info:hover {
            background-color: #a7c0cd;
            border-color: #a7c0cd;
        }
        .btn-danger {
            background-color: #ef5350;
            border-color: #ef5350;
            color: white;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
        .back-link {
            margin-top: 15px; /* Kurangi margin atas */
            text-align: center;
            display: block;
            color: var(--active-text);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
            font-size: 0.9em; /* Perkecil ukuran font link kembali */
        }
        .back-link:hover {
            color: var(--sidebar-hover);
            text-decoration: underline;
        }
        .text-danger {
            color: #e53935 !important;
            text-align: center;
            margin-top: 15px; /* Kurangi margin atas */
            font-weight: bold;
            font-size: 0.9em; /* Perkecil ukuran font pesan error */
        }
        .table th, .table td {
            padding: 8px 10px; /* Perkecil padding sel tabel */
            font-size: 0.9em; /* Perkecil ukuran font sel tabel */
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="header-title"><i class="fas fa-calendar-alt me-2"></i> Daftar Acara</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="add-button-container mb-3 text-end">
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i> Tambah Acara Baru</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Acara</th>
                                    <th>Pembicara</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Tanggal</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->speaker }}</td>
                                        <td>{{ Str::limit($event->description, 50) }}</td>
                                        <td class="text-center">{{ $event->date }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-img">
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('admin.dashboard') }}" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard</a>
            </div>

        @else
            <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Anda tidak memiliki akses ke halaman ini.</p>
        @endif
    </div>
@endsection