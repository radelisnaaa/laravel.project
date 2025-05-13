@extends('layouts.admin-app')

@section('title', 'Edit Pengguna')

@section('title-content')
    <i class="fas fa-user-edit me-2"></i> Edit Pengguna
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Informasi Pengguna</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="participant" {{ old('role', $user->role) === 'participant' ? 'selected' : '' }}>Participant</option>
                                <option value="organization" {{ old('role', $user->role) === 'organization' ? 'selected' : '' }}>Organization</option>
                                <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff</option>
                                {{-- Tambahkan opsi role lain jika ada --}}
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telepon (Opsional)</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="mb-3">
                            <label for="organization" class="form-label">Organisasi (Opsional)</label>
                            <input type="text" class="form-control" id="organization" name="organization" value="{{ old('organization', $user->organization) }}">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pengguna</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Tambahkan style khusus jika diperlukan --}}
@endpush

@push('scripts')
    {{-- Tambahkan script khusus jika diperlukan --}}
@endpush