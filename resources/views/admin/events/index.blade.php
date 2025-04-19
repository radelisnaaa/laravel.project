<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Soft light blue background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin-top: 30px;
        }
        .header-title {
            color: #1e88e5; /* Vibrant blue header */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2em;
        }
        .card {
            border-radius: 15px;
            background-color: #f5f5f5; /* Light gray card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .add-button-container {
            margin-bottom: 20px;
            text-align: right;
        }
        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #1b5e20;
            border: 1px solid #c8e6c9;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #444;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }
        .table thead th {
            background-color: #1565c0;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .event-img {
            width: 80px; /* Reduced size for better table fit */
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .btn-sm {
            padding: 6px 10px;
            font-size: 0.9em;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-info {
            background-color: #1e88e5;
            border-color: #1e88e5;
            color: white;
        }
        .btn-info:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        .btn-danger {
            background-color: #e53935;
            border-color: #e53935;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c62828;
            border-color: #c62828;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
            display: block;
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #1e88e5;
            text-decoration: underline;
        }
        .text-danger {
            color: #e53935 !important;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="header-title"><i class="fas fa-calendar-alt me-2"></i> Daftar Acara</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="add-button-container">
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i> Tambah Acara Baru</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-lg p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
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
                                    <td>{{ Str::limit($event->description, 50) }}</td>
                                    <td class="text-center">{{ $event->date }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-img">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('admin.events.index') }}" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Acara</a>
            </div>

        @else
            <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Anda tidak memiliki akses ke halaman ini.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>