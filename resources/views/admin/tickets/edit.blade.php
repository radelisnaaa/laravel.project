@extends('layouts.admin-app')

@section('title', 'Edit Tiket')

@section('title-content')
    <i class="fas fa-pencil-alt me-2"></i> Edit Tiket
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit me-2"></i> Informasi Tiket</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="event_id" class="form-label fw-bold"><i class="fas fa-calendar-alt me-2"></i> ID Event</label>
                            <input type="number" class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id" value="{{ $ticket->event_id }}" required>
                            @error('event_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ticket_type" class="form-label fw-bold"><i class="fas fa-tag me-2"></i> Jenis Tiket</label>
                            <input type="text" class="form-control @error('ticket_type') is-invalid @enderror" id="ticket_type" name="ticket_type" value="{{ $ticket->ticket_type }}" required>
                            @error('ticket_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold"><i class="fas fa-coins me-2"></i> Harga</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $ticket->price }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quota" class="form-label fw-bold"><i class="fas fa-sort-numeric-up me-2"></i> Kuota</label>
                            <input type="number" class="form-control @error('quota') is-invalid @enderror" id="quota" name="quota" value="{{ $ticket->quota }}" required>
                            @error('quota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Update</button>
                            <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary"><i class="fas fa-ban me-2"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-info"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Tiket</a>
            </div>
        </div>
    </div>
@endsection

