@extends('layouts.admin-app')

@section('content')
<div class="container mt-5">
    <h2>Profil Admin</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>

            <a href="{{ route('admin.profile-edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
        </div>
    </div>
</div>
@endsection
