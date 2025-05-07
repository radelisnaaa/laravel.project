@extends('layouts.user-app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Profil Saya</h2>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user me-2"></i> Informasi Profil</h4>
        </div>
        <div class="card-body">
            <p><i class="fas fa-user-circle me-2"></i> <strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><i class="fas fa-envelope me-2"></i> <strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><i class="fas fa-calendar-alt me-2"></i> <strong>Tanggal Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
            <a href="{{ route('user.profile.edit') }}" class="btn btn-warning"><i class="fas fa-edit me-2"></i> Edit Profil</a>
        </div>
    </div>
</div>
@endsection