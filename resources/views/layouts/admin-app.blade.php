<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Palet Warna yang Diselaraskan dengan User Dashboard */
        :root {
            --body-bg: #e0f7fa;
            --sidebar-bg: #1e88e5;
            --sidebar-text: #fff;
            --sidebar-hover: #1565c0;
            --active-bg: #bbdefb;
            --active-text: #1976d2;
            --content-bg: #fff;
            --text-primary: #444;
            --sidebar-width: 200px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--body-bg);
            margin: 0;
            padding-left: var(--sidebar-width);
            transition: padding-left 0.3s ease-in-out;
        }

        body.sidebar-toggled {
            padding-left: 0;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.toggled {
            transform: translateX(-100%);
        }

        .sidebar .sidebar-brand {
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--sidebar-text);
            display: block;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar .sidebar-brand-info {
            color: var(--sidebar-text);
            display: block;
            text-align: center;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .sidebar .sidebar-nav .nav-item {
            list-style: none;
        }

        .sidebar .sidebar-nav .nav-item .nav-link {
            padding: 0.75rem 1rem;
            color: var(--sidebar-text);
            display: flex; /* Aktifkan flexbox */
            align-items: center;
            justify-content: space-between; /* Distribusikan ruang antara elemen */
            text-decoration: none;
            transition: background-color 0.2s ease-in-out, padding-left 0.2s ease-in-out;
        }

        .sidebar .sidebar-nav .nav-item .nav-link i {
            margin-right: 0.5rem;
        }

        .sidebar .sidebar-nav .nav-item .nav-link .nav-link-text {
            flex-grow: 1; /* Biarkan teks utama mengambil sebagian besar ruang */
        }

        .sidebar .sidebar-nav .nav-item .nav-link .nav-link-info {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6); /* Warna teks info yang lebih pudar */
            text-align: right; /* Ratakan ke kanan */
        }

        .sidebar .sidebar-nav .nav-item .nav-link:hover {
            background-color: var(--sidebar-hover);
            padding-left: 1.25rem;
        }

        .sidebar .sidebar-nav .nav-item .nav-link.active {
            background-color: var(--active-bg);
            color: var(--active-text);
            border-left: 5px solid var(--active-text);
            padding-left: 0.75rem;
            font-weight: 500;
        }

        .content-wrapper {
            flex-grow: 1;
            padding: 1rem;
            background-color: var(--content-bg);
        }
        /* Contoh penambahan style di layouts/admin-app.blade.php */
        .event-card {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: var(--content-bg);
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: box-shadow 0.2s ease-in-out;
        cursor: pointer;}

        .navbar {
            background-color: var(--content-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
            border-bottom: 1px solid #eee;
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--text-primary);
            text-decoration: none;
        }

        .navbar-info {
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.2rem;
            cursor: pointer;
            display: none;
        }

        .toggle-sidebar-btn:focus {
            outline: none;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.toggled {
                transform: translateX(0);
            }
            .toggle-sidebar-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-sidebar-btn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <span class="sidebar-brand-info">Kelola Aplikasi</span>
        <hr class="text-light my-2">
        <div class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span class="nav-link-text">Dashboard</span>
                        <!-- <span class="nav-link-info">Pantau statistik</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span class="nav-link-text">Event</span>
                        <!-- <span class="nav-link-info">Atur acara</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span class="nav-link-text">Pesanan</span>
                        <!-- <span class="nav-link-info">Lihat transaksi</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users me-2"></i>
                        <span class="nav-link-text">Pengguna</span>
                        <!-- <span class="nav-link-info">Kelola akun</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
                        <i class="fas fa-ticket-alt me-2"></i>
                        <span class="nav-link-text">Tiket</span>
                        <!-- <span class="nav-link-info">Validasi & atur</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span class="nav-link-text">Keluar</span>
                            <!-- <span class="nav-link-info">Akhiri sesi</span> -->
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="content-wrapper">
        <nav class="navbar navbar-light bg-light">
            <button class="toggle-sidebar-btn">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">@yield('title-content')</a>
            <span class="navbar-info">
                <i class="fas fa-user-shield me-1"></i> Administrator
            </span>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const body = document.querySelector('body');
        const sidebar = document.querySelector('.sidebar');
        const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');

        toggleSidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('toggled');
            body.classList.toggle('sidebar-toggled');
        });
    </script>
</body>
</html>