@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Tiket Baru</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="event_id" class="form-label">ID Event</label>
                <input type="number" name="event_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ticket_type" class="form-label">Jenis Tiket</label>
                <input type="text" name="ticket_type" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quota" class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection