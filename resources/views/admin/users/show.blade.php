@extends('layouts.admin-app')

@section('title', 'Detail Pengguna')

@section('title-content')
    <i class="fas fa-user-circle me-2"></i> Detail Pengguna
@endsection

@section('content')
    <div class="row justify-content-center"> {{-- Tambahkan kelas justify-content-center --}}
        <div class="col-md-6"> {{-- Atur lebar kolom agar card tidak terlalu lebar --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pengguna</h6>
                </div>
                <div class="card-body">
                    @if ($user)
                        <div class="mb-3">
                            <strong>ID:</strong> {{ $user->id }}
                        </div>
                        <div class="mb-3">
                            <strong>Nama:</strong> {{ $user->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div class="mb-3">
                            <strong>Role:</strong>
                            @if ($user->role === 'admin')
                                <span class="badge bg-success"><i class="fas fa-user-shield me-1"></i>Admin</span>
                            @elseif ($user->role === 'participant')
                                <span class="badge bg-warning text-dark"><i class="fas fa-user me-1"></i>Participant</span>
                            @elseif ($user->role === 'organization')
                                <span class="badge bg-info text-white"><i class="fas fa-building me-1"></i>Organization</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-user-tag me-1"></i>{{ ucfirst($user->role) }}</span>
                            @endif
                        </div>
                        @if ($user->phone)
                            <div class="mb-3">
                                <strong>Telepon:</strong> {{ $user->phone }}
                            </div>
                        @endif
                        @if ($user->organization)
                            <div class="mb-3">
                                <strong>Organisasi:</strong> {{ $user->organization }}
                            </div>
                        @endif
                        {{-- @if ($user->avatar)
                            <div class="mb-3">
                                <strong>Avatar:</strong>
                                <img src="{{ $user->avatar }}" alt="Avatar" width="100" style="border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            </div>
                        @endif --}}

                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pengguna</a>
                    @else
                        <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Pengguna tidak ditemukan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Tambahkan style khusus jika diperlukan --}}
    <style>
        .card-body strong {
            font-weight: bold;
        }
        .badge {
            font-size: 0.875rem;
        }
    </style>
@endpush

@push('scripts')
    {{-- Tambahkan script khusus jika diperlukan --}}
@endpush