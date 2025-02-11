<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Daftar Event Users</h1>

    <!-- Menampilkan pesan sukses atau error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tombol untuk menambahkan data baru -->
    <a href="{{ route('eventusers.create') }}" class="btn btn-primary mb-3">Tambah Event User</a>

    <!-- Tabel untuk menampilkan data EventUser -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventUsers as $eventUser)
                <tr>
                    <td>{{ $eventUser->id }}</td>
                    <td>{{ $eventUser->event->name ?? 'Tidak ada event' }}</td> <!-- Menampilkan nama event -->
                    <td>{{ $eventUser->user->name ?? 'Tidak ada user' }}</td> <!-- Menampilkan nama user -->
                    <td>
                        <!-- Tombol Edit dan Hapus -->
                        <a href="{{ route('eventusers.edit', $eventUser->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('eventusers.destroy', $eventUser->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
