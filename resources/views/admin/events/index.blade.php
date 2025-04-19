<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #81D4FA;
        }

        .container {
            max-width: 1200px;
        }

        .card {
            border-radius: 15px;
            background-color: rgb(169, 217, 243);
        }

        .btn-primary {
            background-color: rgb(103, 196, 240);
            border-color: #2962FF;
        }

        .btn-primary:hover {
            background-color: rgb(29, 138, 206);
            border-color: #2957E4;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Daftar Acara</h1>

    @if (Auth::check() && Auth::user()->role === 'admin')
        <div class="mb-3">
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Tambah Acara Baru</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-lg p-4">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nama Acara</th>
                        <th>Pembicara</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->speaker }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->date }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100">
                            </td>
                            <td>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p class="text-center mt-3 text-danger">Anda tidak memiliki akses ke halaman ini.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>