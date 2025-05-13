@extends('layouts.admin-app')

@section('title', 'Daftar Pengguna')

@section('title-content')
    <i class="fas fa-users me-2"></i> Daftar Pengguna
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role === 'admin')
                                                <span class="badge bg-success"><i class="fas fa-user-shield me-1"></i>Admin</span>
                                            @elseif ($user->role === 'participant')
                                                <span class="badge bg-warning text-dark"><i class="fas fa-user me-1"></i>Participant</span>
                                            @elseif ($user->role === 'organization')
                                                <span class="badge bg-info text-white"><i class="fas fa-building me-1"></i>Organization</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="fas fa-user-tag me-1"></i>{{ ucfirst($user->role) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye me-1"></i>Detail</a>
                                            @if (Auth::check() && Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada pengguna terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if (Auth::check() && Auth::user()->role === 'admin')
                <div class="text-right">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i>Tambah Pengguna Baru</a>
                </div>
            @endif

            @if (!Auth::check())
                <p class="mt-3 text-center">Silakan <a href="{{ route('login') }}">login</a> untuk melihat daftar pengguna.</p>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    {{-- Jika ada style khusus untuk halaman ini bisa ditambahkan di sini --}}
    <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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