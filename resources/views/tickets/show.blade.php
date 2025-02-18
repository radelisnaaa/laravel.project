@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Tiket</h1>
        <p><strong>ID Event:</strong> {{ $ticket->event_id }}</p>
        <p><strong>Jenis Tiket:</strong> {{ $ticket->ticket_type }}</p>
        <p><strong>Harga:</strong> {{ $ticket->price }}</p>
        <p><strong>Kuota:</strong> {{ $ticket->quota }}</p>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection