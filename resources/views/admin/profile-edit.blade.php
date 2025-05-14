@extends('layouts.admin-app')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="container mt-5">
    <h2>Edit Profil Admin</h2>

    @if (session('success'))
        <div class="alert alert-success bg-success text-white">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger bg-danger text-white">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label text-primary">Nama</label>
            <input type="text" name="name" id="name" class="form-control border-primary"
                   value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-primary">Email</label>
            <input type="email" name="email" id="email" class="form-control border-primary"
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-primary">Password Baru (opsional)</label>
            <input type="password" name="password" id="password" class="form-control border-primary">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
        </div>

        <button type="submit" class="btn btn-primary bg-primary text-white">Simpan Perubahan</button>
    </form>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah form submit default

        // Lakukan submit form secara manual menggunakan AJAX
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value  //ambil token csrf
            },
            body: new URLSearchParams($(this).serialize())  //serialize data form
        })
        .then(response => {
            if (response.ok) {
                // Redirect ke dashboard setelah berhasil
                window.location.href = "{{ route('admin.dashboard') }}"; //ubah route
            } else {
                // Handle error jika diperlukan
                alert('Terjadi kesalahan saat menyimpan perubahan.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan.');
        });
    });
</script>
@endsection
