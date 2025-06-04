<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Selamat Datang di Event Kami!')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #007bff; /* Biru cerah, sesuai dengan card-header dashboard */
            --secondary-color: #6c757d; /* Abu-abu netral */
            --light-bg: #f8f9fa; /* Latar belakang terang */
            --dark-text: #343a40; /* Teks gelap */
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--dark-text);
            background-color: var(--light-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-brand, .nav-link {
            font-weight: 500;
        }

        .navbar-light .navbar-nav .nav-link {
            color: var(--dark-text);
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Sedikit lebih gelap dari primary */
            border-color: #0056b3;
        }

        main {
            flex: 1; /* Agar konten utama mengisi ruang yang tersedia */
        }

        .footer {
            background-color: var(--dark-text); /* Footer gelap */
            color: #ffffff;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        /* Gaya untuk kartu (jika digunakan di halaman publik) */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05); /* Sedikit bayangan untuk kedalaman */
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .hover-shadow:hover {
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }

        .transition-scale:hover {
            transform: scale(1.05); /* Sedikit lebih besar saat di-hover */
        }
    </style>
    @yield('head_extra') {{-- Untuk CSS atau meta tag tambahan spesifik halaman --}}
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h4 class="mb-0 text-primary">Nama Event Anda</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="publicNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('events.index') }}">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/kontak') }}">Kontak</a>
                        </li>
                    </ul>
                    <div class="d-flex ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">Masuk</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        @yield('content') {{-- Konten spesifik dari setiap halaman publik akan masuk di sini --}}
    </main>

    <footer class="footer py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Nama Event Anda. Semua Hak Cipta Dilindungi.</p>
            <div class="mt-2">
                <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts_extra') {{-- Untuk script JS tambahan spesifik halaman --}}
</body>
</html>