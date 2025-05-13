@extends('layouts.admin-app')

@section('title', 'Daftar Tiket')

@section('title-content')
    <i class="fas fa-ticket-alt me-2"></i> Daftar Tiket Tersedia
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tiket</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> ID</th>
                                    <th><i class="fas fa-calendar-alt"></i> Event</th>
                                    <th><i class="fas fa-tag"></i> Jenis Tiket</th>
                                    <th><i class="fas fa-coins"></i> Harga</th>
                                    <th><i class="fas fa-sort-numeric-up"></i> Kuota</th>
                                    <th><i class="fas fa-cubes"></i> Stok Tersisa</th>
                                    <th><i class="fas fa-cogs"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    @php
                                        $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
                                    @endphp
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->event->name }}</td>
                                        <td>{{ $ticket->ticket_type }}</td>
                                        <td>
                                        Rp.{{ number_format($ticket->price, 0, ',', '.') }}
                                        </td>

                                        <td>{{ $ticket->quota }}</td>
                                        <td>
                                            @if ($stokTersisa > 0)
                                                <span class="badge bg-success"><i class="fas fa-check me-1"></i> {{ $stokTersisa }} tersedia</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i> Stok habis</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tiket ini?')" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center"><i class="fas fa-exclamation-circle me-2"></i> Tidak ada tiket tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if (Auth::check())
                <div class="text-right">
                    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i> Tambah Tiket Baru</a>
                </div>
            @else
                <p class="mt-3 text-center">Silakan <a href="{{ route('login') }}" class="login-link"><i class="fas fa-sign-in-alt me-1"></i> login</a> untuk menambah tiket.</p>
            @endif
        </div>
    </div>
@endsection

@push('styles')
  @push('styles')
    {{-- Jika ada style khusus untuk halaman ini bisa ditambahkan di sini --}}
    <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .table th i,
        .btn-primary i { /* Hanya targetkan ikon di dalam tombol primary (Tambah Tiket Baru) */
            color: #007bff; /* Warna biru yang kamu inginkan */
        }
    </style>
@endpush
  

@push('scripts')
    {{-- Jika ada script khusus untuk halaman ini bisa ditambahkan di sini --}}
    <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush