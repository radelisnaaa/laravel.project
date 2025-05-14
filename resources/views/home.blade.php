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
            background-color: #e3f2fd;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #0d6efd;
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: #0b5ed7;
        }

        .navbar-brand {
            color: #0d6efd;
            font-weight: 600;
        }

        .hero {
            background: linear-gradient(135deg, #e0f7fa, #b3e5fc);
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
            color: #555;
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
            font-weight: 600;
        }

        .card {
            border: 1px solid #e0f7fa;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #0d6efd;
        }

        .footer {
            background-color: #e3f2fd;
            padding: 20px 0;
            text-align: center;
            color: #0d6efd;
        }

        .nav-item {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-rocket me-2"></i> Event Virtual Anda
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#beranda">Beranda</a>
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
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                            </li>
                        @endauth
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
                <p class="lead">Selamat datang di platform event virtual kami yang inovatif!</p>
                <p>Kami menyediakan solusi terbaik untuk kebutuhan event virtual Anda, mulai dari webinar hingga konferensi
                    besar.</p>
            </div>
        </section>

        <section id="tentang-kami" class="section">
            <div class="container">
                <h2>Tentang Kami</h2>
                <p>Kami adalah tim yang berdedikasi untuk menciptakan pengalaman event virtual yang tak terlupakan. Dengan
                    pengalaman bertahun-tahun di industri ini, kami memahami betul apa yang Anda butuhkan untuk membuat event
                    virtual yang sukses.</p>
                <p>Misi kami adalah menyediakan platform yang mudah digunakan, handal, dan dilengkapi dengan fitur-fitur canggih
                    untuk memastikan setiap event berjalan dengan lancar dan efektif.</p>
            </div>
        </section>

        <section id="layanan" class="section">
            <div class="container">
                <h2>Layanan Kami</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Webinar</h5>
                                <p class="card-text">Platform webinar interaktif dengan fitur tanya jawab, polling, dan
                                    pendaftaran peserta.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Konferensi Virtual</h5>
                                <p class="card-text">Solusi lengkap untuk konferensi virtual dengan multi-sesi, ruang pameran,
                                    dan networking.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pameran Virtual</h5>
                                <p class="card-text">Platform pameran virtual dengan booth interaktif, brosur digital, dan
                                    fitur chat.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="event" class="section">
            <div class="container">
                <h2>Event Kami</h2>
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ Storage::url('images/' . $event->image) }}" class="card-img-top"
                                    alt="{{ $event->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->name }}</h5>
                                    <p class="card-text">{{ $event->description }}</p>
                                    <p class="card-text">
                                        @if ($user->created_at)
                                            {{ $user->created_at->format('d M Y') }}
                                        @else
                                            <em>Belum tersedia</em>
                                        @endif
                                    </p>
                                    <p>
                                        <strong>Waktu:</strong>
                                        @if ($event->start_time && $event->end_time)
                                            {{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }}
                                        @else
                                            <em>Tidak tersedia</em>
                                        @endif
                                    </p>

                                    </p>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Detail
                                        Event</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 text-center">
                    <a href="{{ route('events.index') }}" class="btn btn-outline-primary">Lihat Semua Event</a>
                </div>
            </div>
        </section>

        <section id="kontak" class="section">
            <div class="container">
                <h2>Hubungi Kami</h2>
                <p>Silakan hubungi kami untuk informasi lebih lanjut atau untuk mendiskusikan kebutuhan event virtual Anda.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Alamat:</strong><br>
                            Jl. Raya Contoh No. 123<br>
                            Kota Contoh, Provinsi Contoh
                        </div>
                        <div>
                            <strong>Email:</strong><br>
                            info@eventvirtual.com
                        </div>
                        <div>
                            <strong>Telepon:</strong><br>
                            +62 123 4567 890
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Event Virtual Anda. All rights reserved.</p>
            <p>
                <a href="#" class="text-decoration-none text-primary me-2">Kebijakan Privasi</a> |
                <a href="#" class="text-decoration-none text-primary">Syarat & Ketentuan</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
