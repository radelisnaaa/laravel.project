<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #2196f3;
            border-color: #2196f3;
        }

        .btn-primary:hover {
            background-color: #1976d2;
            border-color: #1976d2;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #2196f3;
            color: white;
            border-bottom: none;
        }

        .card-title {
            margin-bottom: 0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 auto;
                width: 100%; /* Full width on smaller screens */
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1><i class="fas fa-users"></i> Event User</h1>
                <p class="lead">Kelola event yang diikuti oleh user.</p>
            </div>
            <div>
                <a href="{{ route('eventusers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Event User
                </a>
            </div>
        </div>

        <div class="row">
            @forelse($eventUsers as $eventUser)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $eventUser->event->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>User:</strong> {{ $eventUser->user->name }}</p>
                            <a href="{{ route('eventusers.edit', $eventUser->id) }}"
                                class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('eventusers.destroy', $eventUser->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                    Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Tidak ada data</p>
                </div>
            @endforelse
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>