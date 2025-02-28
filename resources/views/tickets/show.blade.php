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

    
            <p class="card-text"><strong>ID Event:</strong> {{ $ticket->event_id }}</p>
            <p class="card-text"><strong>Jenis Tiket:</strong> {{ $ticket->ticket_type }}</p>
            <p class="card-text"><strong>Harga:</strong> {{ $ticket->price }}</p>
            <p class="card-text"><strong>Kuota:</strong> {{ $ticket->quota }}</p>


            <div class="d-grid gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-secondary">KEMBALI</a>
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary">EDIT</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>