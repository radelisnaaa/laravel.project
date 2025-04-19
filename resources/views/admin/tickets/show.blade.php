<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Detail Tiket</h1>

    <div class="alert alert-danger text-center" role="alert">
        <strong>Perhatian!</strong> Menghapus tiket akan menghapus semua data terkait tiket ini.
    </div>
            <p class="card-text"><strong>ID Event:</strong> {{ $ticket->event_id }}</p>
            <p class="card-text"><strong>Jenis Tiket:</strong> {{ $ticket->ticket_type }}</p>
            <p class="card-text"><strong>Harga:</strong> {{ $ticket->price }}</p>
            <p class="card-text"><strong>Kuota:</strong> {{ $ticket->quota }}</p>


            <div class="d-grid gap-2">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">KEMBALI</a>
                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-primary">EDIT</a>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">HAPUS</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>