<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EventSphere: Temukan Event Virtual Terbaik Anda')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome (for icons) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- Google Fonts: Poppins (matches home page) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">

    <style>
        /* Variabel Warna (Konsisten dengan home.blade.php) */
        :root {
            --primary-color: #4A90E2; /* Biru modern */
            --secondary-color: #6C7A89; /* Abu-abu netral */
            --light-bg: #F2F5F8; /* Latar belakang terang, sedikit kebiruan */
            --dark-text: #2C3E50; /* Teks gelap pekat */
            --gradient-start: #4A90E2; /* Awal gradien biru */
            --gradient-end: #8CC0F0; /* Akhir gradien biru lebih terang */
            --danger-color: #E74C3C; /* Merah untuk logout */
            --accent-color: #7B68EE; /* Warna aksen ungu */
        }

        body {
            font-family: 'Poppins', sans-serif; /* Menggunakan Poppins untuk seluruh situs */
            color: var(--dark-text);
            background-color: var(--light-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff !important; /* Pastikan navbar putih bersih */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important; /* Shadow lebih halus */
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand {
            font-weight: 700; /* Lebih tebal */
            font-size: 1.8rem; /* Ukuran lebih besar */
            color: var(--primary-color) !important;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent-color) !important; /* Warna aksen saat hover */
        }

        .navbar-nav .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 10px; /* Jarak antar menu */
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        /* Tombol di Navbar */
        .btn-navbar-primary {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 30px; /* Lebih melengkung */
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-navbar-primary:hover {
            background: linear-gradient(to left, #3A7BBF, #6AB8F0);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* Main Content Area */
        main {
            flex: 1; /* Agar konten utama mengisi ruang yang tersedia */
            padding-top: 0; /* Hero section punya padding sendiri */
            padding-bottom: 0; /* CTA section punya padding sendiri */
        }

        /* Footer */
        .footer {
            background-color: var(--dark-text); /* Footer gelap pekat */
            color: #E0E0E0; /* Teks abu-abu terang */
            padding: 50px 0 30px; /* Padding lebih besar */
            font-size: 0.95em;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .footer .list-unstyled a {
            color: #E0E0E0;
            text-decoration: none;
            line-height: 2.2;
            transition: color 0.3s ease;
        }

        .footer .list-unstyled a:hover {
            color: var(--primary-color);
        }

        .footer .social-icons a {
            font-size: 1.5em;
            color: #E0E0E0;
            margin: 0 12px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer .social-icons a:hover {
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 25px;
            margin-top: 30px;
        }

        /* Utility classes (from previous, ensure consistency) */
        .card {
            border: none;
            border-radius: 0.75rem; /* Sedikit lebih melengkung */
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.06); /* Sedikit bayangan untuk kedalaman */
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .hover-shadow:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12) !important;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }

        .transition-scale:hover {
            transform: scale(1.02); /* Sedikit lebih besar saat di-hover */
        }

        /* Responsive adjustments for Navbar */
        @media (max-width: 991.98px) {
            .navbar-nav {
                text-align: center;
                margin-top: 15px;
                margin-bottom: 15px;
            }
            .navbar-nav .nav-item {
                margin: 5px 0;
            }
            .navbar-nav .nav-link.active::after {
                width: 50px;
                left: 50%;
                transform: translateX(-50%);
                bottom: -3px;
            }
            .d-flex.ms-lg-3 {
                justify-content: center;
            }
            .btn-navbar-primary {
                width: 80%; /* Tombol login di mobile lebih lebar */
                margin-top: 10px;
            }
        }

        @media (max-width: 767.98px) {
            .footer {
                padding: 40px 0 20px;
                text-align: center;
            }
            .footer h5 {
                margin-bottom: 15px;
                margin-top: 25px;
            }
            .footer .list-unstyled {
                padding-left: 0;
            }
            .footer .social-icons {
                margin-top: 20px;
            }
        }
    </style>
    @yield('head_extra') {{-- Untuk CSS atau meta tag tambahan spesifik halaman --}}
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-satellite-dish me-2"></i> EventSphere
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="publicNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}">Event Virtual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('kontak') ? 'active' : '' }}" href="{{ url('/kontak') }}">Kontak</a>
                        </li>
                    </ul>
                    <div class="d-flex ms-lg-3">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-navbar-primary px-4">Masuk</a>
                        @else
                            {{-- Jika sudah login, bisa arahkan ke dashboard atau tampilkan nama --}}
                            <a href="{{ route('user.dashboard') }}" class="btn btn-navbar-primary px-4">Dasbor Saya</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        @yield('content') {{-- Konten spesifik dari setiap halaman publik akan masuk di sini --}}
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <h5 class="mb-3"><i class="fas fa-satellite-dish me-2"></i> EventSphere</h5>
                    <p>Platform terdepan untuk menemukan dan menghadiri event virtual terbaik dari seluruh dunia. Konektivitas tanpa batas, wawasan tak terbatas.</p>
                </div>
                <div class="col-md-2 offset-md-1 mb-4 mb-md-0">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ route('events.index') }}">Event Virtual</a></li>
                        <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                        <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Bantuan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Dukungan</a></li>
                    </ul>
                </div>
                <div class="col-md-3 text-center text-md-start">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row footer-bottom">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} EventSphere. Semua Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts_extra') {{-- Untuk script JS tambahan spesifik halaman --}}
</body>
</html>