@extends('layouts.public-app')

@section('title', 'Beranda - EventSphere: Temukan Event Virtual Terbaik Anda')

@section('head_extra')
    <style>
        /* Variabel Warna */
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
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins jika tersedia, atau sans-serif default */
            color: var(--dark-text);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(74, 144, 226, 0.75), rgba(140, 192, 240, 0.75)), url('https://source.unsplash.com/1920x1080/?virtual-conference,online-event,digital-webinar,abstract-tech-background') no-repeat center center;
            background-size: cover;
            background-attachment: fixed; /* Parallax effect */
            color: white;
            padding: 160px 0 120px; /* Padding top & bottom lebih besar */
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(74, 144, 226, 0.2), rgba(140, 192, 240, 0.2));
            z-index: 0;
            opacity: 0.9; /* Sedikit lebih transparan */
        }

        .hero-content {
            position: relative;
            z-index: 1;
            transform: translateY(0);
            opacity: 1;
            transition: all 0.8s ease-out;
        }

        .hero-content.fade-in {
            animation: fadeInDown 1s ease-out;
        }

        .hero-section h1 {
            font-size: 4.5em; /* Ukuran font lebih besar */
            font-weight: 800; /* Lebih tebal */
            margin-bottom: 30px;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);
            letter-spacing: -1.5px; /* Sedikit lebih rapat */
        }

        .hero-section p {
            font-size: 1.5em;
            margin-bottom: 60px;
            max-width: 950px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease-out 0.3s forwards;
            opacity: 0; /* Dimulai dari tidak terlihat */
        }

        .hero-section .btn {
            padding: 18px 50px;
            font-size: 1.35em;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            margin: 0 12px;
            animation: zoomIn 1s ease-out 0.6s forwards;
            opacity: 0;
        }

        .hero-section .btn-primary {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            border: none;
        }

        .hero-section .btn-primary:hover {
            background: linear-gradient(to left, #3A7BBF, #6AB8F0); /* Gradien terbalik, sedikit lebih gelap */
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.35);
        }

        .hero-section .btn-outline-light {
            border: 2px solid white;
            color: white;
            background-color: transparent;
        }

        .hero-section .btn-outline-light:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 15px 30px rgba(255, 255, 255, 0.35);
        }

        .hero-section .btn-danger-custom {
            background-color: var(--danger-color);
            border: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hero-section .btn-danger-custom:hover {
            background-color: #c0392b; /* Warna merah lebih gelap saat hover */
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.35);
        }

        /* Section Fitur/Keunggulan */
        .features-section {
            background-color: var(--light-bg);
            padding: 100px 0;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.08); /* Bayangan di atas lebih halus */
        }

        .features-section h2, .how-it-works-section h2 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 60px;
            position: relative;
            display: inline-block;
            font-size: 3.2em;
        }

        .features-section h2::after, .how-it-works-section h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -15px;
            transform: translateX(-50%);
            width: 100px; /* Lebih lebar */
            height: 5px; /* Lebih tebal */
            background-color: var(--primary-color);
            border-radius: 3px;
        }

        .features-section .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            height: 100%;
            background-color: white; /* Latar belakang card putih */
            border-bottom: 5px solid var(--primary-color); /* Garis bawah accent */
        }

        .features-section .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .features-section .card-body {
            padding: 40px 30px;
            text-align: center;
        }

        .features-section .card i {
            color: var(--accent-color); /* Menggunakan warna aksen untuk ikon */
            font-size: 5em; /* Ikon lebih besar */
            margin-bottom: 30px;
            display: block;
            transition: transform 0.4s ease;
        }

        .features-section .card:hover i {
            transform: scale(1.2) rotate(8deg); /* Efek putar lebih jelas */
            color: var(--primary-color); /* Warna ikon berubah saat hover */
        }

        .features-section .card-title {
            font-weight: 700;
            color: var(--dark-text); /* Judul card warna gelap */
            margin-top: 15px;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .features-section .card-text {
            color: var(--secondary-color);
            line-height: 1.8;
            font-size: 1.1em;
        }

        /* How It Works Section */
        .how-it-works-section {
            background-color: white;
            padding: 100px 0;
        }

        .how-it-works-section .step-card {
            border: 1px solid #e0e0e0;
            border-radius: 1rem;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
        }

        .how-it-works-section .step-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }

        .how-it-works-section .step-card .step-number {
            font-size: 2.5em;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 20px;
            background-color: var(--light-bg);
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 3px solid var(--gradient-end);
        }

        .how-it-works-section .step-card i {
            font-size: 3em;
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .how-it-works-section .step-card h5 {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .how-it-works-section .step-card p {
            color: var(--secondary-color);
            line-height: 1.7;
        }

        /* CTA Section Bawah */
        .cta-section {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            color: white;
            padding: 90px 0;
            text-align: center;
            box-shadow: inset 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .cta-section h2 {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .cta-section p {
            font-size: 1.4em;
            margin-bottom: 50px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .cta-section .btn {
            background-color: white;
            color: var(--primary-color);
            padding: 18px 50px;
            font-size: 1.35em;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .cta-section .btn:hover {
            background-color: #eef2f5;
            color: #3A7BBF;
            transform: translateY(-8px) scale(1.04);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.35);
        }

        /* Keyframe Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-70px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(70px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.7); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Responsif */
        @media (max-width: 1400px) {
            .hero-section h1 { font-size: 4em; }
            .hero-section p { font-size: 1.4em; }
            .hero-section .btn { font-size: 1.25em; padding: 16px 45px; }
            .features-section h2, .how-it-works-section h2 { font-size: 3em; }
            .features-section .card-title { font-size: 1.7em; }
            .cta-section h2 { font-size: 3em; }
            .cta-section p { font-size: 1.3em; }
            .cta-section .btn { font-size: 1.25em; padding: 16px 45px; }
        }

        @media (max-width: 1200px) {
            .hero-section h1 { font-size: 3.5em; }
            .hero-section p { font-size: 1.3em; }
            .hero-section .btn { font-size: 1.15em; padding: 15px 40px; margin: 0 8px; }
            .features-section h2, .how-it-works-section h2 { font-size: 2.8em; }
            .features-section .card-title { font-size: 1.6em; }
            .features-section .card i { font-size: 4.5em; }
            .how-it-works-section .step-card h5 { font-size: 1.4em; }
            .cta-section h2 { font-size: 2.8em; }
            .cta-section p { font-size: 1.2em; }
            .cta-section .btn { font-size: 1.15em; padding: 15px 40px; }
        }

        @media (max-width: 992px) {
            .hero-section { padding: 140px 0 100px; }
            .hero-section h1 { font-size: 3em; }
            .hero-section p { font-size: 1.2em; margin-bottom: 50px; }
            .hero-section .btn { font-size: 1.05em; padding: 14px 35px; }
            .features-section, .how-it-works-section { padding: 80px 0; }
            .features-section h2, .how-it-works-section h2 { font-size: 2.5em; margin-bottom: 50px; }
            .features-section .card-body { padding: 35px 25px; }
            .features-section .card i { font-size: 4em; }
            .features-section .card-title { font-size: 1.5em; }
            .features-section .card-text { font-size: 1em; }
            .how-it-works-section .step-card { margin-bottom: 30px; }
            .cta-section { padding: 70px 0; }
            .cta-section h2 { font-size: 2.5em; margin-bottom: 25px; }
            .cta-section p { font-size: 1.1em; margin-bottom: 40px; }
            .cta-section .btn { font-size: 1.05em; padding: 14px 35px; }
        }

        @media (max-width: 768px) {
            .hero-section { padding: 120px 0 80px; }
            .hero-section h1 { font-size: 2.5em; margin-bottom: 20px; }
            .hero-section p { font-size: 1.1em; margin-bottom: 40px; }
            .hero-section .btn {
                font-size: 1em;
                padding: 12px 30px;
                display: block;
                margin: 0 auto 15px;
                width: 85%;
            }
            .features-section, .how-it-works-section { padding: 60px 0; }
            .features-section h2, .how-it-works-section h2 { font-size: 2em; margin-bottom: 40px; }
            .features-section .card { margin-bottom: 30px; }
            .features-section .card i { font-size: 3.5em; margin-bottom: 20px; }
            .features-section .card-title { font-size: 1.4em; }
            .how-it-works-section .step-card { margin-bottom: 25px; }
            .cta-section { padding: 60px 0; }
            .cta-section h2 { font-size: 2em; }
            .cta-section p { font-size: 1em; }
            .cta-section .btn { width: 85%; }
        }

        @media (max-width: 576px) {
            .hero-section { padding: 100px 0 60px; }
            .hero-section h1 { font-size: 2em; }
            .hero-section p { font-size: 0.95em; }
            .hero-section .btn { width: 90%; }
            .features-section .card-body { padding: 25px 15px; }
            .features-section .card i { font-size: 3em; }
            .features-section .card-title { font-size: 1.2em; }
            .how-it-works-section .step-card { padding: 20px; }
            .how-it-works-section .step-card .step-number { font-size: 2em; width: 60px; height: 60px; }
            .how-it-works-section .step-card i { font-size: 2.5em; }
            .how-it-works-section .step-card h5 { font-size: 1.3em; }
            .cta-section h2 { font-size: 1.8em; }
            .cta-section p { font-size: 0.9em; }
        }
    </style>
    {{-- Memuat Google Fonts (Poppins) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">
@endsection

@section('content')
    <section class="hero-section">
        <div class="container hero-content">
            @auth
                {{-- Tampilan untuk pengguna yang sudah login --}}
                <h1 class="animate__animated animate__fadeInDown">
                    Selamat Datang Kembali, {{ Auth::user()->name }}!
                </h1>
                <p class="animate__animated animate__fadeInUp animate__delay-0-3s">
                    Nikmati pengalaman event virtual terbaik. Jelajahi event online terbaru atau kelola pesanan Anda.
                </p>
                <a href="{{ route('events.index') }}" class="btn btn-primary animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-desktop me-2"></i> Jelajahi Event Virtual
                </a>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light ms-md-3 animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-user-circle me-2"></i> Dasbor Saya
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-md-3 mt-3 mt-md-0">
                    @csrf
                    <button type="submit" class="btn btn-danger-custom animate__animated animate__zoomIn animate__delay-0-9s">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            @else
                {{-- Tampilan untuk pengguna yang belum login --}}
                <h1 class="animate__animated animate__fadeInDown">
                    Temukan & Ikuti Event Virtual Terbaik Anda!
                </h1>
                <p class="animate__animated animate__fadeInUp animate__delay-0-3s">
                    Jelajahi berbagai webinar, workshop online, konser virtual, dan konferensi digital yang dapat Anda ikuti dari mana saja.
                </p>
                <a href="{{ route('login') }}" class="btn btn-primary animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light ms-md-3 animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-user-plus me-2"></i> Daftar Gratis
                </a>
            @endauth
        </div>
    </section>

    <section class="features-section">
        <div class="container">
            <h2 class="text-center mb-5">Mengapa Memilih EventSphere untuk Event Virtual?</h2>
            <div class="row">
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-globe"></i>
                            <h5 class="card-title">Akses Global, Tanpa Batas</h5>
                            <p class="card-text">Ikuti event dari mana saja di dunia, tanpa perlu khawatir perjalanan atau akomodasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-comments"></i>
                            <h5 class="card-title">Interaksi Real-time</h5>
                            <p class="card-text">Terlibat aktif dengan pembicara dan peserta lain melalui fitur chat, Q&A, dan jajak pendapat interaktif.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-laptop-code"></i>
                            <h5 class="card-title">Teknologi Mutakhir</h5>
                            <p class="card-text">Nikmati pengalaman streaming yang lancar dan platform yang stabil untuk event virtual Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works-section">
        <div class="container">
            <h2 class="text-center mb-5">Bagaimana EventSphere Bekerja?</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4 d-flex">
                    <div class="step-card flex-fill">
                        <div class="step-number">1</div>
                        <i class="fas fa-search"></i>
                        <h5>Cari Event Impian Anda</h5>
                        <p>Jelajahi berbagai kategori event virtual mulai dari workshop, seminar, hingga konser.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="step-card flex-fill">
                        <div class="step-number">2</div>
                        <i class="fas fa-ticket-alt"></i>
                        <h5>Dapatkan Tiket Mudah</h5>
                        <p>Pilih tiket yang Anda inginkan dan selesaikan pembayaran dengan cepat dan aman.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="step-card flex-fill">
                        <div class="step-number">3</div>
                        <i class="fas fa-video"></i>
                        <h5>Nikmati Event Virtual Anda</h5>
                        <p>Dapatkan link akses dan saksikan event favorit Anda langsung dari perangkat Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Anda bisa menambahkan Section Event Unggulan Virtual di sini jika ada data dari database --}}
    {{-- <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-primary">Event Virtual Unggulan</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 transition hover-shadow">
                        <img src="https://source.unsplash.com/400x250/?online-webinar,virtual-summit" class="card-img-top" alt="Online Webinar">
                        <div class="card-body">
                            <h5 class="card-title">Webinar Strategi Pemasaran Digital</h5>
                            <p class="card-text"><i class="fas fa-calendar-alt text-primary me-2"></i> 10 Agustus 2025</p>
                            <p class="card-text"><i class="fas fa-laptop text-primary me-2"></i> Online via Zoom</p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">Detail Event</a>
                        </div>
                    </div>
                </div>
                </div>
            <div class="text-center mt-5">
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Event Virtual <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section> --}}

    <section class="cta-section">
        <div class="container">
            <h2>Siap Terhubung dengan Dunia Event Virtual?</h2>
            <p>Daftar sekarang dan mulailah petualangan event virtual Anda! Temukan pengalaman baru, perluas wawasan, dan bergabunglah dengan komunitas global.</p>
            <a href="{{ route('register') }}" class="btn btn-light">
                <i class="fas fa-handshake me-2"></i> Gabung EventSphere Sekarang!
            </a>
        </div>
    </section>

@endsection

@section('scripts_extra')
    {{-- Script JS spesifik halaman ini jika diperlukan --}}
@endsection