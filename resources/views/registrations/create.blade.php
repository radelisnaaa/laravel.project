<!-- resources/views/registrations/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Tambah Pendaftaran</h1>
    <form action="{{ route('registrations.store') }}" method="POST">
        @csrf
        <label for="user_id">Pilih Pengguna</label>
        <select name="user_id" id="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <label for="event_id">Pilih Acara</label>
        <select name="event_id" id="event_id">
            @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>

        <label for="status">Status</label>
        <input type="text" name="status" id="status" required>

        <button type="submit">Simpan</button>
    </form>
@endsection
