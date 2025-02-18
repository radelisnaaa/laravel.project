@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Tiket</h1>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Tambah Tiket</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event</th>
                    <th>Jenis Tiket</th>
                    <th>Harga</th>
                    <th>Kuota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->event_id }}</td>
                        <td>{{ $ticket->ticket_type }}</td>
                        <td>{{ $ticket->price }}</td>
                        <td>{{ $ticket->quota }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
