<!-- resources/views/registrations/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Daftar Pendaftaran</h1>
    <a href="{{ route('registrations.create') }}">Tambah Pendaftaran</a>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Event</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td>{{ $registration->user->name }}</td>
                    <td>{{ $registration->event->name }}</td>
                    <td>{{ $registration->status }}</td>
                    <td>
                    <div>{{ Auth::user()?->name ?? 'Guest' }}</div>
                        <a href="{{ route('registrations.edit', $registration->id) }}">Edit</a>
                        <form action="{{ route('registrations.destroy', $registration->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
