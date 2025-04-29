<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelajahi Event Lain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
            font-family: 'Nunito', sans-serif;
            color: #555;
            margin: 0;
            padding: 30px;
            line-height: 1.6;
            transition: background-color 0.3s ease; /* Transisi untuk perubahan tema */
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            font-size: 2.5em;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Grid responsif */
            gap: 30px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #e1e8ed;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            overflow: hidden; /* Untuk efek rounded pada gambar */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); /* Efek hover lebih menonjol */
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            transition: transform 0.3s ease-in-out; /* Efek zoom pada gambar */
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Ruang antara teks dan tombol */
            height: calc(100% - 220px); /* Tinggi menyesuaikan */
        }

        .card-title {
            color: #34495e;
            font-size: 1.6em;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .card-text {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .card-actions {
            display: flex;
            gap: 10px; /* Jarak antar tombol */
        }

        .btn-info {
            background-color: #3498db;
            border-color: #3498db;
            color: #fff;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-info:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            border: 1px solid #3498db;
            color: #3498db;
            background-color: transparent;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-outline-primary:hover {
            background-color: #e0f2f7; /* Warna latar belakang hover lembut */
            color: #2980b9;
            border-color: #2980b9;
        }

        .text-center {
            color: #777;
            font-size: 1.2rem;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4"><i class="fas fa-compass me-2"></i> Jelajahi Event Lain</h2>
        <div class="card-grid">
            @if ($events->isNotEmpty())
                @foreach ($events as $event)
                    <div class="card">
                        <img src="{{ Storage::url('images/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}">
                        <div class="card-body">
                            <div>
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">{{ Str::limit($event->description, 160) }}</p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">
                                    <i class="fas fa-info-circle me-2"></i> Detail
                                </a>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-heart me-2"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    Tidak ada acara untuk saat ini.
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>