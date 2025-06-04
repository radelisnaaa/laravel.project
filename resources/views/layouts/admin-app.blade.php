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
            --transition-duration: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--body-bg);
            margin: 0;
            transition: padding-left var(--transition-duration) ease-in-out;
        }

        body.sidebar-toggled {
            padding-left: var(--sidebar-width);
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform var(--transition-duration) ease-in-out;
        }

        .sidebar.toggled {
            transform: translateX(0);
        }

        .sidebar .sidebar-brand {
            padding: 1.2rem 1.5rem;
            display: block;
            font-weight: bold;
            font-size: 1.2rem;
            color: var(--sidebar-text);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-decoration: none;
        }

        .sidebar .sidebar-brand-info {
            padding: 0 1.5rem;
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 1.2rem;
        }

        .sidebar .sidebar-nav .nav-item {
            list-style: none;
        }

        .sidebar .sidebar-nav .nav-link {
            padding: 0.85rem 1.5rem;
            color: var(--sidebar-text);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: background-color var(--transition-duration) ease-in-out, padding-left var(--transition-duration) ease-in-out;
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

        .sidebar .nav-link.active {
            background-color: var(--active-bg);
            color: var(--active-text);
            border-left: 5px solid var(--active-text);
            font-weight: 500;
        }

        .content-wrapper {
            min-height: 100vh;
            margin-left: 0;
            transition: margin-left var(--transition-duration) ease-in-out;
            background-color: var(--content-bg);
        }

        .content-wrapper.sidebar-toggled {
            margin-left: var(--sidebar-width);
        }

        .navbar {
            background-color: var(--content-bg);
            border-bottom: 1px solid #eee;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--text-primary);
            text-decoration: none;
        }

        .toggle-sidebar-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 900;
            display: none;
            opacity: 0;
            transition: opacity var(--transition-duration) ease-in-out;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (min-width: 769px) {
    /* Sidebar tetap terlihat di desktop */
    .sidebar {
        transform: translateX(0) !important;
    }

    .sidebar-overlay {
        display: none !important;
    }

    .content-wrapper {
        margin-left: var(--sidebar-width);
    }

    body.sidebar-toggled .content-wrapper {
        margin-left: var(--sidebar-width);
    }
}

@media (max-width: 768px) {
    .content-wrapper {
        transition: margin-left var(--transition-duration) ease-in-out;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .transition {
        transition: all 0.3s ease-in-out;
    }

    .transition-scale:hover {
        transform: scale(1.2);
    }
}


    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar" id="sidebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-rocket me-2"></i> Admin Panel
        </a>
        <div class="sidebar-brand-info">Kelola Aplikasi</div>
        <ul class="sidebar-nav nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                    <i class="fas fa-calendar-alt"></i> Event
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i> Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.tickets.*') ? 'active' : '' }}" href="{{ route('admin.tickets.index') }}">
                    <i class="fas fa-ticket-alt"></i> Tiket
                </a>
            </li>
        </ul>

        <hr class="text-light my-2">

        <div class="nav-item dropdown px-3">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                <li><a class="dropdown-item" href="{{ route('admin.profile.show') }}"><i class="fas fa-user-cog me-2"></i> Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="content-wrapper" id="contentWrapper">
        <nav class="navbar">
            <button class="toggle-sidebar-btn" id="toggleSidebarBtn">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">@yield('title-content', 'Dashboard')</a>
            <div>
                <i class="fas fa-user-shield me-1"></i> Administrator
            </div>
        </nav>
        <div class="container-fluid py-3" id="mainContent">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('contentWrapper');
    const toggleBtn = document.getElementById('toggleSidebarBtn');
    const overlay = document.getElementById('sidebarOverlay');

    // Fungsi untuk membuka sidebar
    function openSidebar() {
        sidebar.classList.add('toggled');
        contentWrapper.classList.add('sidebar-toggled');
        overlay.classList.add('show');
    }

    // Fungsi untuk menutup sidebar
    function closeSidebar() {
        sidebar.classList.remove('toggled');
        contentWrapper.classList.remove('sidebar-toggled');
        overlay.classList.remove('show');
    }

    // Toggle sidebar
    function toggleSidebar() {
        const isOpen = sidebar.classList.contains('toggled');
        if (isOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    // Event listener untuk tombol toggle
    toggleBtn.addEventListener('click', toggleSidebar);

    // Tutup sidebar jika overlay di klik
    overlay.addEventListener('click', closeSidebar);

    // Tutup sidebar di layar besar (desktop)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 769) {
            closeSidebar();
        }
        
    });
</script>



    @stack('scripts')
</body>
</html>
