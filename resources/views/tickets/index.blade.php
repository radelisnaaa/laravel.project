
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket</title>
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
    <h1 class="text-center mb-4 text-primary">Daftar Tiket</h1>

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
                <th>ID</th>
                <th>Event</th>
                <th>Jenis Tiket</th>
                <th>Harga</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
@forelse ($tickets as $ticket)
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->event_id }}</td>
        <td>{{ $ticket->ticket_type }}</td>
        <td>{{ $ticket->price }}</td>
        <td>{{ $ticket->quota }}</td>
        <td>
          
        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">Detail</a>
        @if (Auth::check() && Auth::id() === $ticket->user_id)
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">Hapus</button>
            </form>
        @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">Tidak ada tiket.</td>
    </tr>
@endforelse
</tbody>

        </table>
    </div>

    @if (Auth::check())
        <div class="d-grid gap-2 mt-3">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">Tambah Tiket Baru</a>
        </div>
    @else
        <p class="text-center mt-3">Silakan <a href="{{ route('login') }}">login</a> untuk menambah tiket.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

