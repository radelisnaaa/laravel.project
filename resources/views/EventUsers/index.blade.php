@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Daftar Acara</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-lg p-4">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Acara</th>
                    <th>Pembicara</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($event as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ Storage::url('images/' . $event->image) }}" alt="Gambar Acara" width="100" class="rounded">
                        </td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->speaker }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->date }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">Detail</a>
                            @if (Auth::check() && Auth::id() === $event->user_id)
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada acara.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (Auth::check())
        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Acara Baru</a>
        </div>
    @else
        <p class="text-center mt-3">Silakan <a href="{{ route('login') }}">login</a> untuk menambah acara.</p>
    @endif
</div>
@endsection
