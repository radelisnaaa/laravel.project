<!-- resources/views/registrations/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Pendaftaran</h1>
    <form action="{{ route('registrations.update', $registration->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="user_id">Pilih Pengguna</label>
        <select name="user_id" id="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if($registration->user_id == $user->id) selected @endif>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <label for="event_id">Pilih Acara</label>
        <select name="event_id" id="event_id">
            @foreach($events as $event)
                <option value="{{ $event->id }}" @if($registration->event_id == $event->id) selected @endif>
                    {{ $event->name }}
                </option>
            @endforeach
        </select>

        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="{{ $registration->status }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
