<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd; /* Light blue background (tetap dipertahankan) */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #f9f9f9; /* Diubah menjadi abu-abu sangat muda */
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            width: 100%;
        }
        .header-title {
            color: #1e88e5; /* A more vibrant blue */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .table thead th {
            background-color: #1976d2; /* Another nice blue */
            color: white;
            padding: 12px 15px;
            text-align: center;
            font-weight: normal;
        }
        .table tbody td {
            padding: 10px 15px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #e0f7fa; /* Light hover effect */
        }
        .badge-success {
            background-color: #4caf50;
            color: white;
            border-radius: 6px;
            padding: 5px 8px;
            font-size: 0.9em;
        }
        .badge-danger {
            background-color: #f44336;
            color: white;
            border-radius: 6px;
            padding: 5px 8px;
            font-size: 0.9em;
        }
        .btn-primary {
            background-color: #2196f3; /* A bright blue */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: #1976d2;
        }
        .btn-info {
            background-color: #03a9f4;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
        }
        .btn-info:hover {
            background-color: #0288d1;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #333;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
        }
        .btn-warning:hover {
            background-color: #e0b300;
        }
        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
        }
        .d-grid {
            display: grid;
            gap: 10px;
        }
        .mt-3 {
            margin-top: 20px;
        }
        .text-center {
            text-align: center;
        }
        .login-link {
            color: #1e88e5;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="header-title"><i class="fas fa-ticket-alt me-2"></i> Daftar Tiket Tersedia</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-calendar-alt"></i> Event</th>
                        <th><i class="fas fa-tag"></i> Jenis Tiket</th>
                        <th><i class="fas fa-coins"></i> Harga</th>
                        <th><i class="fas fa-sort-numeric-up"></i> Kuota</th>
                        <th><i class="fas fa-cubes"></i> Stok Tersisa</th>
                        <th><i class="fas fa-cogs"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        @php
                            $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
                        @endphp
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->event->name }}</td>
                            <td>{{ $ticket->ticket_type }}</td>
                            <td>
                                @if ($ticket->price >= 1000)
                                    Rp {{ number_format($ticket->price / 1000, 0, ',', '.') }} ribu
                                @else
                                    Rp {{ number_format($ticket->price, 0, ',', '.') }}
                                @endif
                            </td>
                            <td>{{ $ticket->quota }}</td>
                            <td>
                                @if ($stokTersisa > 0)
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i> {{ $stokTersisa }} tersedia</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times me-1"></i> Stok habis</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tiket ini?')" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center"><i class="fas fa-exclamation-circle me-2"></i> Tidak ada tiket tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (Auth::check())
            <div class="d-grid gap-2 mt-3">
                <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i> Tambah Tiket Baru</a>
            </div>
        @else
            <p class="text-center mt-3">Silakan <a href="{{ route('login') }}" class="login-link"><i class="fas fa-sign-in-alt me-1"></i> login</a> untuk menambah tiket.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>