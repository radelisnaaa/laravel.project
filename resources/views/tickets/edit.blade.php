@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Tiket</h1>
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="event_id" class="form-label">ID Event</label>
                <input type="number" name="event_id" class="form-control" value="{{ $ticket->event_id }}" required>
            </div>
            <div class="mb-3">
                <label for="ticket_type" class="form-label">Jenis Tiket</label>
                <input type="text" name="ticket_type" class="form-control" value="{{ $ticket->ticket_type }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $ticket->price }}" required>
            </div>
            <div class="mb-3">
                <label for="quota" class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control" value="{{ $ticket->quota }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection