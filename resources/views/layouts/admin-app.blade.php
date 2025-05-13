<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
    :root {
        --body-bg: #e0f7fa;
        --sidebar-bg: #1e88e5;
        --sidebar-text: #fff;
        --sidebar-hover: #1565c0;
        --active-bg: #bbdefb;
        --active-text: #1976d2;
        --content-bg: #fff;
        --text-primary: #444;
        --sidebar-width: 220px;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--body-bg);
        margin: 0;
        padding-left: 0; /* Default padding dihilangkan */
        transition: padding-left 0.3s ease-in-out;
    }

    body.sidebar-toggled {
        padding-left: var(--sidebar-width); /* Padding ditambahkan saat sidebar terbuka */
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
        transform: translateX(-100%); /* Default tersembunyi */
    }

    .sidebar.toggled {
        transform: translateX(0); /* Muncul saat di-toggle */
    }

    .sidebar .sidebar-brand {
        padding: 1.2rem 1.5rem;
        text-align: left;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--sidebar-text);
        display: block;
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar .sidebar-brand-info {
        color: var(--sidebar-text);
        display: block;
        text-align: left;
        font-size: 0.9rem;
        margin-bottom: 1.2rem;
        opacity: 0.8;
        padding: 0 1.5rem;
    }

    .sidebar .sidebar-nav .nav-item {
        list-style: none;
    }

    .sidebar .sidebar-nav .nav-link {
        padding: 0.85rem 1.5rem;
        color: var(--sidebar-text);
        display: flex;
        align-items: center;
        justify-content: flex-start;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out, padding-left 0.2s ease-in-out;
    }

    .sidebar .sidebar-nav .nav-link i {
        margin-right: 0.75rem;
        width: 24px;
        text-align: center;
    }

    .sidebar .sidebar-nav .nav-link:hover {
        background-color: var(--sidebar-hover);
        padding-left: 1.75rem;
    }

    .sidebar .sidebar-nav .nav-link.active {
        background-color: var(--active-bg);
        color: var(--active-text);
        border-left: 5px solid var(--active-text);
        padding-left: 1.25rem;
        font-weight: 500;
    }

    .content-wrapper {
        flex-grow: 1;
        padding: 1.5rem;
        background-color: var(--content-bg);
        min-height: 100vh;
        transition: margin-left 0.3s ease-in-out; /* Tambah transisi untuk margin */
        margin-left: 0; /* Default margin */
    }

    .content-wrapper.sidebar-toggled {
        margin-left: var(--sidebar-width); /* Margin saat sidebar terbuka */
    }

    .navbar {
        background-color: var(--content-bg);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        padding: 0.75rem 1.5rem;
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

    .toggle-sidebar-btn {
        background: none;
        border: none;
        color: var(--text-primary);
        font-size: 1.2rem;
        cursor: pointer;
        /* display: none; */ /* Hilangkan ini agar tombol terlihat di desktop */
    }

    .toggle-sidebar-btn:focus {
        outline: none;
    }

    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 90;
        transition: opacity 0.3s ease-in-out;
    }

    .sidebar-overlay.d-none {
        display: none;
        opacity: 0;
    }

    .sidebar-overlay.show {
        display: block !important;
        opacity: 1;
    }

    @media (max-width: 768px) {
        body.sidebar-toggled {
            padding-left: var(--sidebar-width); /* Biarkan tetap ada untuk konsistensi */
        }
    }
</style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-rocket me-2"></i> Admin Panel
        </a>
        <span class="sidebar-brand-info">Kelola Aplikasi</span>
        <hr class="text-light my-2">
        <ul class="sidebar-nav nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                    <i class="fas fa-calendar-alt"></i>
                    Event
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
                    <i class="fas fa-ticket-alt"></i>
                    Tiket
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay d-none"></div>

    <!-- Konten -->
    <div class="content-wrapper">
        <nav class="navbar navbar-light">
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
        const sidebarOverlay = document.querySelector('.sidebar-overlay');

        function openSidebar() {
            sidebar.classList.add('toggled');
            body.classList.add('sidebar-toggled');
            sidebarOverlay.classList.remove('d-none');
            sidebarOverlay.classList.add('show');
        }

        function closeSidebar() {
            sidebar.classList.remove('toggled');
            body.classList.remove('sidebar-toggled');
            sidebarOverlay.classList.remove('show');
            sidebarOverlay.classList.add('d-none');
        }

        toggleSidebarBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('toggled')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        sidebarOverlay.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 769) {
                closeSidebar();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
