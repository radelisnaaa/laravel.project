@extends('layouts.admin-app')

@section('title', 'Detail Tiket')

@section('title-content')
    <i class="fas fa-ticket-alt me-2"></i> Detail Tiket
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Detail Tiket</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="fas fa-calendar-alt me-2"></i> Event:</strong> {{ $ticket->event->name }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-tag me-2"></i> Jenis Tiket:</strong> {{ $ticket->ticket_type }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-coins me-2"></i> Harga:</strong> Rp{{ number_format($ticket->price, 0, ',', '.') }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-sort-numeric-up me-2"></i> Kuota:</strong> {{ $ticket->quota }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="fas fa-cubes me-2"></i> Stok Tersisa:</strong>
                        @php
                            $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
                        @endphp
                        <span class="{{ $stokTersisa > 0 ? 'text-success' : 'text-danger' }} font-weight-bold">
                            {{ $stokTersisa > 0 ? $stokTersisa . ' tersedia' : 'Stok habis' }}
                        </span>
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->is_admin)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi Admin</h6>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons">
                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt me-2"></i> Edit Tiket</a>
                            <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt me-2"></i> Hapus Tiket</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
                @endphp
                @if($stokTersisa > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pesan Tiket</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label font-weight-bold"><i class="fas fa-ticket me-2"></i> Jumlah Tiket:</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $stokTersisa }}" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100"><i class="fas fa-check me-2"></i> Konfirmasi Pesanan</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-triangle me-2"></i> Tiket sudah habis, tidak bisa dipesan.
                    </div>
                @endif
            @endif

            <div class="mt-3">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Tiket</a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Tambahkan style khusus jika diperlukan --}}
    <style>
        .action-buttons .btn {
            margin-right: 10px;
        }
    </style>
@endpush

@push('scripts')
    {{-- Tambahkan script khusus jika diperlukan --}}
@endpush