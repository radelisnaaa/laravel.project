<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 15px;
            padding: 20px;
        }
        .table img {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Daftar Member</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-lg">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No.Telepon</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->status }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">Detail</a>
                        @if (Auth::check() && Auth::id() === $member->user_id)
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada member.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if (Auth::check())
        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('members.create') }}" class="btn btn-primary">Tambah Member Baru</a>
        </div>
    @else
        <p class="text-center mt-3">Silakan <a href="{{ route('login') }}">login</a> untuk menambah member.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
