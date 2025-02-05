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

    @if($event->users->contains(auth()->user()))
            <form action="{{ route('event.unregister', ['userId' => auth()->id(), 'eventId' => $event->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Keluar dari Event</button>
            </form>
        @else
            <form action="{{ route('event.register', ['userId' => auth()->id(), 'eventId' => $event->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Daftar Event</button>
            </form>
        @endif
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
