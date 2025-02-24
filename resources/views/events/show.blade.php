<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #e3f2fd, #f8f9fa); /* Gradien biru lembut */
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 900px;
        }

        .card {
            border: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); /* Bayangan lebih tebal */
            border-radius: 20px; /* Sudut lebih melengkung */
            overflow: hidden;
            transition: transform 0.3s ease; /* Transisi lebih halus */
        }

        .card:hover {
            transform: translateY(-5px); /* Card sedikit naik saat hover */
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2); /* Bayangan lebih tebal saat hover */
        }

        .card-img-top {
            max-height: 500px; /* Tinggi gambar lebih besar */
            object-fit: cover;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            transition: transform 0.3s ease;
        }

        .card-img-top:hover {
            transform: scale(1.05); /* Gambar sedikit membesar saat hover */
        }

        .card-body {
            padding: 40px;
        }

        .card-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }

        .card-text {
            color: #555;
            margin-bottom: 15px;
        }

        .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px; /* Sudut tombol melengkung */
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(to right, #007bff, #17a2b8); /* Gradien biru pada tombol */
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #0056b3, #138496); /* Gradien biru lebih gelap saat hover */
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .zoom-link {
            margin-top: 25px;
        }

        .card-text i {
            color: #007bff;
            margin-right: 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-img-top {
                max-height: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($event->image && file_exists(public_path('storage/' . $event->image)))
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top img-fluid"
                        alt="Gambar Acara">
                    @else
                    <img src="https://via.placeholder.com/900x500" class="card-img-top img-fluid"
                        alt="Gambar Placeholder">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $event->name }}</h2>
                        <p class="card-text"><i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                        <p class="card-text"><i class="fas fa-user"></i> {{ $event->speaker }}</p>
                        <p class="card-text"><i class="fas fa-info-circle"></i> {{ $event->description }}</p>

                        @if (!empty($event->zoom_link))
                        <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-primary zoom-link">
                            <i class="fas fa-video"></i> Join Zoom Meeting
                        </a>
                        @else
                        <button class="btn btn-secondary disabled zoom-link" aria-disabled="true">
                            <i class="fas fa-video"></i> Zoom (Belum Tersedia)
                        </button>
                        @endif

                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('events.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> KEMBALI
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>