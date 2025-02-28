<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Virtual Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #e3f2fd; /* Light blue background */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #0d6efd; /* Blue nav links */
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: #0b5ed7; /* Darker blue on hover/active */
        }

        .hero {
            background: linear-gradient(135deg, #e0f7fa, #b3e5fc); /* Gradient blue background */
            text-align: center;
            padding: 150px 0;
            color: #333;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #0d6efd;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }

        .section {
            padding: 80px 0;
        }

        .section h2 {
            color: #0d6efd;
            margin-bottom: 30px;
        }

        .card {
            border: 1px solid #e0f7fa;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #e3f2fd;
            padding: 20px 0;
            text-align: center;
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Logo Event Anda</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#beranda">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang-kami">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#layanan">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#event">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kontak">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="hero">
            <div class="hero-content">
                <h1 class="animate__animated animate__fadeInDown">Event Virtual yang Tak Terlupakan</h1>
                <p class="animate__animated animate__fadeInUp">Rasakan pengalaman event virtual yang luar biasa bersama
                    kami.</p>
                <button class="btn btn-primary animate__animated animate__zoomIn">Daftar Sekarang</button>
            </div>
        </section>
    </header>

    <main>
        <section id="beranda" class="section">
            <div class="container">
                <h2>Beranda</h2>
                <p>Selamat datang di platform event virtual kami yang inovatif!</p>
            </div>
        </section>

        <section id="tentang-kami" class="section">
            <div class="container">
                <h2>Tentang Kami</h2>
                <p>Kami adalah tim yang berdedikasi untuk menciptakan pengalaman event virtual yang tak terlupakan.</p>
            </div>
        </section>

        <section id="layanan" class="section">
            <div class="container">
                <h2>Layanan Kami</h2>
                <ul>
                    <li>Webinar</li>
                    <li>Konferensi Virtual</li>
                    <li>Pameran Virtual</li>
                </ul>
            </div>
        </section>

        <section id="event" class="section">
            <div class="container">
                <h2>Event Kami</h2>
                <div class="row">
                    @foreach ($events as $event)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ Storage::url('images/' . $event->image) }}" class="card-img-top"
                                alt="{{ $event->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">{{ $event->description }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Detail Event</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="kontak" class="section">
            <div class="container">
                <h2>Hubungi Kami</h2>
                <form>
                    </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 Event Virtual Anda</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>