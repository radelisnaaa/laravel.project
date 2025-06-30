@extends('layouts.public-app')

@section('title', 'Masuk - EventSphere')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center py-4">
                    <h3 class="fw-bold my-0">Masuk ke Akun EventSphere Anda</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label mb-2">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label mb-2">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-check mb-5"> {{-- Tambah mb-5 untuk ruang sebelum tombol --}}
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Ingat Saya') }}
                            </label>
                        </div>

                        <div class="d-grid gap-2"> {{-- Gunakan d-grid untuk tombol penuh --}}
                            <button type="submit" class="btn btn-navbar-primary">
                                {{ __('Masuk') }}
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}" style="color: var(--primary-color);">
                                    {{ __('Lupa Kata Sandi Anda?') }}
                                </a>
                            </div>
                        @endif

                        <div class="text-center mt-4">
                            <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: var(--primary-color);">Daftar Sekarang</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection