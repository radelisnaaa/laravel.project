@extends('layouts.user-app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <h2 class="mb-3" style="font-size: 1.75rem;">Edit Profil</h2>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-2">
            <h6 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Informasi Profil</h6>
        </div>
        <div class="card-body py-3">
            @if (session('success'))
                <div class="alert alert-success py-2 mb-3">
                    <small><i class="fas fa-check-circle me-1"></i> {{ session('success') }}</small>
                </div>
            @endif

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="name" class="form-label"><small>Nama</small></label>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label"><small>Email</small></label>
                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label"><small>Password Baru <span class="text-muted">(Biarkan kosong jika tidak ingin diubah)</span></small></label>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label"><small>Konfirmasi Password</small></label>
                    <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> <small>Kembali</small>
                    </a>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save me-1"></i> <small>Perbarui</small>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection