@extends('layouts.public-app')

@section('title', 'Beranda - EventSphere: Temukan Event Terbaik Anda')

@section('head_extra')
    <style>
        /* Variabel Warna (ambil dari public-app.blade.php jika tidak ada di sini) */
        :root {
            --primary-color: #007bff; /* Biru cerah */
            --secondary-color: #6c757d; /* Abu-abu netral */
            --light-bg: #f8f9fa; /* Latar belakang terang */
            --dark-text: #343a40; /* Teks gelap */
            --gradient-start: #007bff;
            --gradient-end: #17a2b8;
            --danger-color: #dc3545; /* Merah untuk logout */
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 123, 255, 0.7), rgba(23, 162, 184, 0.7)), url('https://source.unsplash.com/1920x1080/?concert,seminar,festival,grogol') no-repeat center center;
            background-size: cover;
            background-attachment: fixed; /* Parallax effect */
            color: white;
            padding: 150px 0 100px; /* Padding top lebih besar */
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
            background: linear-gradient(45deg, rgba(0, 123, 255, 0.2), rgba(23, 162, 184, 0.2));
            z-index: 0;
            opacity: 0.8;
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
            font-size: 4.2em; /* Ukuran font lebih besar */
            font-weight: 800; /* Lebih tebal */
            margin-bottom: 25px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            letter-spacing: -1px; /* Sedikit lebih rapat */
        }

        .hero-section p {
            font-size: 1.4em;
            margin-bottom: 50px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            animation: fadeInUp 1s ease-out 0.3s forwards;
            opacity: 0; /* Dimulai dari tidak terlihat */
        }

        .hero-section .btn {
            padding: 16px 45px;
            font-size: 1.25em;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Kurva transisi lebih halus */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin: 0 10px;
            animation: zoomIn 1s ease-out 0.6s forwards;
            opacity: 0;
        }

        .hero-section .btn-primary {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            border: none;
        }

        .hero-section .btn-primary:hover {
            background: linear-gradient(to left, #0056b3, #138496); /* Gradien terbalik */
            transform: translateY(-7px) scale(1.03);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        .hero-section .btn-outline-light {
            border: 2px solid white;
            color: white;
            background-color: transparent;
        }

        .hero-section .btn-outline-light:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-7px) scale(1.03);
            box-shadow: 0 12px 25px rgba(255, 255, 255, 0.3);
        }

        .hero-section .btn-danger-custom { /* Gaya khusus untuk tombol logout */
            background-color: var(--danger-color);
            border: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hero-section .btn-danger-custom:hover {
            background-color: #c82333; /* Warna merah lebih gelap saat hover */
            transform: translateY(-7px) scale(1.03);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }


        /* Section Fitur/Keunggulan */
        .features-section {
            background-color: white; /* Kontras dengan hero section */
            padding: 100px 0;
            box-shadow: 0 -10px 20px rgba(0, 0, 0, 0.05); /* Bayangan di atas */
        }

        .features-section h2 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 60px;
            position: relative;
            display: inline-block;
        }

        .features-section h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -15px;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .features-section .card {
            border: none;
            border-radius: 1.5rem; /* Lebih melengkung */
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1); /* Bayangan lebih dalam */
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden; /* Penting untuk radius card */
            height: 100%; /* Pastikan tinggi kartu sama */
            background-color: #f0f8ff; /* Latar belakang card lebih lembut */
        }

        .features-section .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .features-section .card-body {
            padding: 40px 30px;
            text-align: center;
        }

        .features-section .card i {
            color: var(--primary-color);
            font-size: 4.5em; /* Ikon lebih besar */
            margin-bottom: 25px;
            display: block; /* Agar ikon di tengah */
            transition: transform 0.4s ease;
        }

        .features-section .card:hover i {
            transform: scale(1.15) rotate(5deg); /* Efek putar sedikit */
        }

        .features-section .card-title {
            font-weight: 700;
            color: var(--primary-color); /* Judul card warna primer */
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 1.6em;
        }

        .features-section .card-text {
            color: var(--secondary-color);
            line-height: 1.7;
        }

        /* Section CTA Bawah */
        .cta-section {
            background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));
            color: white;
            padding: 80px 0;
            text-align: center;
            box-shadow: inset 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .cta-section h2 {
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 25px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        }

        .cta-section p {
            font-size: 1.3em;
            margin-bottom: 45px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-section .btn {
            background-color: white;
            color: var(--primary-color);
            padding: 16px 45px;
            font-size: 1.25em;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .cta-section .btn:hover {
            background-color: #e2e6ea;
            color: #0056b3;
            transform: translateY(-7px) scale(1.03);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        /* Keyframe Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Responsif */
        @media (max-width: 1200px) {
            .hero-section h1 { font-size: 3.8em; }
            .hero-section p { font-size: 1.2em; }
            .hero-section .btn { font-size: 1.1em; padding: 14px 40px; }
            .features-section .card-title { font-size: 1.4em; }
        }

        @media (max-width: 992px) {
            .hero-section { padding: 120px 0 80px; }
            .hero-section h1 { font-size: 3em; }
            .hero-section p { font-size: 1.1em; }
            .features-section { padding: 80px 0; }
            .features-section h2 { font-size: 2.5em; margin-bottom: 50px; }
            .features-section .card-body { padding: 30px 20px; }
            .features-section .card i { font-size: 4em; }
            .cta-section { padding: 60px 0; }
            .cta-section h2 { font-size: 2.5em; }
            .cta-section p { font-size: 1.1em; }
        }

        @media (max-width: 768px) {
            .hero-section { padding: 100px 0 60px; }
            .hero-section h1 { font-size: 2.5em; }
            .hero-section p { font-size: 1em; }
            .hero-section .btn {
                font-size: 1em;
                padding: 12px 30px;
                display: block; /* Tombol jadi stack */
                margin: 0 auto 15px; /* Margin bawah untuk setiap tombol */
                width: 80%; /* Lebar tombol di mobile */
            }
            .features-section { padding: 60px 0; }
            .features-section h2 { font-size: 2em; margin-bottom: 40px; }
            .features-section .card { margin-bottom: 30px; }
            .features-section .card i { font-size: 3.5em; }
            .features-section .card-title { font-size: 1.3em; }
            .cta-section { padding: 50px 0; }
            .cta-section h2 { font-size: 2em; }
            .cta-section p { font-size: 1em; }
        }

        @media (max-width: 576px) {
            .hero-section h1 { font-size: 2em; }
            .hero-section p { font-size: 0.9em; }
            .hero-section .btn { width: 90%; }
            .features-section .card-body { padding: 25px 15px; }
        }
    </style>
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
                    Nikmati pengalaman event terbaik. Jelajahi event baru atau kelola pesanan Anda.
                </p>
                <a href="{{ route('events.index') }}" class="btn btn-primary animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-search me-2"></i> Jelajahi Event
                </a>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light ms-md-3 animate__animated animate__zoomIn animate__delay-0-6s">
                    <i class="fas fa-home me-2"></i> Dasbor Saya
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
                    Temukan & Ikuti Event Terbaik di Grogol!
                </h1>
                <p class="animate__animated animate__fadeInUp animate__delay-0-3s">
                    Jelajahi berbagai seminar, workshop, konser, dan festival yang akan memperkaya pengalaman Anda.
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
            <h2 class="text-center mb-5">Mengapa Memilih EventSphere?</h2>
            <div class="row">
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-ticket-alt"></i>
                            <h5 class="card-title">Tiket Mudah & Cepat</h5>
                            <p class="card-text">Dapatkan tiket event favorit Anda hanya dalam hitungan menit, tanpa ribet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-search-dollar"></i>
                            <h5 class="card-title">Promo & Diskon Eksklusif</h5>
                            <p class="card-text">Nikmati penawaran spesial dan diskon menarik untuk berbagai event pilihan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <i class="fas fa-users"></i>
                            <h5 class="card-title">Komunitas Aktif</h5>
                            <p class="card-text">Terhubung dengan sesama penggemar event dan perluas jaringan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Opsional: Section Event Unggulan --}}
    {{-- Anda bisa memuat data event unggulan di sini dari controller dan meloopingnya --}}
    {{-- <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-primary">Event Unggulan</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 transition hover-shadow">
                        <img src="https://via.placeholder.com/400x250?text=Event+Konser" class="card-img-top" alt="Event Konser">
                        <div class="card-body">
                            <h5 class="card-title">Konser Malam Bintang</h5>
                            <p class="card-text"><i class="fas fa-calendar-alt text-primary me-2"></i> 20 Juli 2025</p>
                            <p class="card-text"><i class="fas fa-map-marker-alt text-primary me-2"></i> GOR Wijaya Kusuma</p>
                            <a href="#" class="btn btn-primary btn-sm mt-2">Detail Event</a>
                        </div>
                    </div>
                </div>
                </div>
            <div class="text-center mt-5">
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-lg">Lihat Semua Event <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section> --}}

    <section class="cta-section">
        <div class="container">
            <h2>Siap Bergabung dengan EventSphere?</h2>
            <p>Daftar sekarang dan mulailah petualangan event Anda! Jangan lewatkan keseruan yang menanti Anda di Grogol dan sekitarnya.</p>
            <a href="{{ route('register') }}" class="btn btn-light">
                <i class="fas fa-user-plus me-2"></i> Bergabung Sekarang!
            </a>
        </div>
    </section>

@endsection

@section('scripts_extra')
    {{-- Tambahkan script JS spesifik halaman ini jika diperlukan --}}
@endsection