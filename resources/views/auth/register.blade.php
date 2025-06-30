@extends('layouts.public-app')

@section('title', 'Daftar - EventSphere')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center py-4">
                    <h3 class="fw-bold my-0">Buat Akun Baru di EventSphere</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label mb-2">{{ __('Nama Lengkap') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label mb-2">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label mb-2">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-5"> {{-- Tambah mb-5 untuk ruang sebelum tombol --}}
                            <label for="password_confirmation" class="form-label mb-2">{{ __('Konfirmasi Kata Sandi') }}</label>
                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2"> {{-- Gunakan d-grid untuk tombol penuh --}}
                            <button type="submit" class="btn btn-navbar-primary">
                                {{ __('Daftar') }}
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: var(--primary-color);">Masuk di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection