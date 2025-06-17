<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Pengguna')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />

    <style>
        /* Palet Warna yang Diselaraskan */
        :root {
            --body-bg: #e0f7fa; /* Light Cyan */
            --sidebar-bg: #1e88e5; /* Strong Blue */
            --sidebar-text: #fff;
            --sidebar-hover: #1565c0; /* Darker Blue */
            --active-bg: #bbdefb; /* Light Blue */
            --active-text: #1976d2; /* Medium Blue */
            --content-bg: #fff; /* White */
            --text-primary: #34495e; /* Dark Grayish Blue for general text */
            --brand-color: #0d47a1; /* Even darker blue for brand */
            --accent-green: #28a745; /* Success color for accents like events */
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
            background-color: var(--body-bg);
            margin: 0;
            padding-left: var(--sidebar-width); /* Default padding for desktop */
            transition: padding-left 0.3s ease-in-out;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden; /* Prevent horizontal scrollbar during transitions */
        }

        /* Adjust body padding when sidebar is fully collapsed on desktop */
        body.sidebar-collapsed-desktop {
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
            z-index: 1050; /* Higher than navbar, lower than modal/offcanvas backdrop */
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.25); /* Stronger shadow for depth */
            overflow-y: auto;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar state for mobile (off-canvas) */
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%); /* Hidden by default on mobile */
                box-shadow: none; /* No shadow when hidden */
            }
            .sidebar.show { /* Use .show for explicit visibility */
                transform: translateX(0);
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.25); /* Show shadow when open */
            }
            body {
                padding-left: 0 !important; /* No padding on mobile */
            }
        }

        /* Sidebar state for desktop */
        @media (min-width: 768px) {
            .sidebar.collapsed { /* Collapsed state for desktop */
                transform: translateX(-100%);
            }
            body.sidebar-collapsed-desktop {
                padding-left: 0; /* Content takes full width */
            }
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            font-weight: bold;
            color: var(--sidebar-text);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
            font-size: 1.6rem; /* Slightly larger */
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* Space between icon and text */
        }
        .sidebar-header i {
            color: var(--active-bg);
            font-size: 1.3em;
        }

        .sidebar-nav {
            flex-grow: 1;
            padding-bottom: 20px;
        }

        .sidebar-nav a {
            color: var(--sidebar-text);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out, padding-left 0.2s ease-in-out, color 0.2s ease-in-out;
            font-size: 1.05rem;
            position: relative; /* For the pseudo-element active indicator */
        }
        .sidebar-nav a i {
            margin-right: 15px;
            font-size: 1.1em;
            transition: color 0.2s ease-in-out;
        }

        .sidebar-nav a:hover {
            background-color: var(--sidebar-hover);
            padding-left: 25px;
        }

        .sidebar-nav a.active {
            background-color: var(--active-bg);
            color: var(--active-text);
            font-weight: 600;
            padding-left: 20px; /* Consistent padding for active state */
        }
        .sidebar-nav a.active i {
            color: var(--active-text);
        }
        /* Active indicator bar */
        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background-color: var(--active-text);
            border-radius: 0 3px 3px 0; /* Rounded top/bottom right */
        }


        .content-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
            position: relative; /* For the mobile overlay backdrop */
        }

        .navbar-top {
            background-color: var(--content-bg);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08); /* Slightly stronger shadow */
            padding: 1rem 1.5rem;
            z-index: 1000; /* Below sidebar */
        }

        .navbar-brand-custom {
            color: var(--brand-color) !important;
            font-weight: bold;
            font-size: 1.3rem;
            white-space: nowrap; /* Prevent wrapping */
        }

        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.6em; /* Larger icon */
            padding: 8px 12px; /* More clickable area */
            cursor: pointer;
            position: absolute; /* Relative to navbar for better integration */
            left: 15px; /* Aligned with navbar padding */
            z-index: 1001; /* Above navbar content */
            display: none; /* Hidden by default, shown on mobile */
            transition: color 0.2s ease-in-out, transform 0.2s ease-in-out;
            border-radius: 0.375rem; /* Bootstrap button border-radius */
        }

        .toggle-sidebar-btn:hover {
            color: var(--sidebar-bg);
            transform: scale(1.05);
        }

        .toggle-sidebar-btn:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        /* Mobile specific adjustments for toggle button and navbar */
        @media (max-width: 767.98px) {
            .toggle-sidebar-btn {
                display: block; /* Show button on small screens */
            }
            .navbar-top .container-fluid {
                padding-left: 70px; /* Make space for the toggle button */
            }
            .navbar-brand-custom {
                display: none; /* Hide brand name on very small screens, let navbar handle */
            }
            .navbar-top .nav-item.dropdown {
                margin-left: auto; /* Push notification to the right on mobile */
            }
        }

        .content-area {
            padding: 20px;
            padding-top: 25px; /* Adjust top padding for content below navbar */
            flex-grow: 1;
        }

        /* Overlay backdrop for mobile sidebar */
        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Between content and sidebar */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }


        /* FullCalendar specific styles (from previous dashboard code) */
        .fc-toolbar-title {
            color: var(--text-primary);
            font-size: 1.75rem !important;
        }
        .fc-button-primary {
            background-color: var(--sidebar-bg) !important;
            border-color: var(--sidebar-bg) !important;
        }
        .fc-button-primary:hover {
            background-color: var(--sidebar-hover) !important;
            border-color: var(--sidebar-hover) !important;
        }
        .fc-event {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
            border-radius: 0.25rem;
            padding: 2px 5px;
            font-size: 0.85em;
        }
    </style>

    @yield('head')
</head>
<body>

    <button class="toggle-sidebar-btn" aria-label="Toggle sidebar" id="toggleSidebarBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-ticket-alt"></i> MyEvent
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('user.dashboard') }}" class="{{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dasbor
            </a>
            <a href="{{ route('user.profile') }}" class="{{ Request::routeIs('user.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profil
            </a>
            <a href="{{ route('user.orders.index') }}" class="{{ Request::routeIs('user.orders.index') ? 'active' : '' }}">
                <i class="fas fa-history"></i> Riwayat
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <div class="content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-top sticky-top">
            <div class="container-fluid">
                <span class="navbar-brand navbar-brand-custom d-none d-md-inline me-auto">Halo, {{ auth()->user()->name ?? 'Pengguna' }}</span>

                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi">
                            <i class="fas fa-bell fa-lg"></i>
                            @if(isset($notifications) && count($notifications) > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($notifications) }}
                                    <span class="visually-hidden">notifikasi baru</span>
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notifDropdown">
                            <li class="dropdown-header text-muted">Notifikasi Anda</li>
                            @if(isset($notifications) && count($notifications) > 0)
                                @foreach($notifications as $notif)
                                    <li><a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="fas fa-info-circle text-info me-2"></i> {{ $notif }}
                                    </a></li>
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center text-primary" href="#">Lihat Semua Notifikasi</a></li>
                            @else
                                <li><span class="dropdown-item text-muted">Tidak ada notifikasi baru.</span></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js'></script> {{-- For localization --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;
            const sidebar = document.getElementById('sidebar');
            const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            // Function to manage sidebar state
            function toggleSidebar() {
                if (window.innerWidth < 768) {
                    // Mobile: Sidebar acts as an off-canvas overlay
                    sidebar.classList.toggle('show');
                    sidebarBackdrop.classList.toggle('show');
                    body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : ''; // Prevent body scroll when sidebar open
                } else {
                    // Desktop: Sidebar collapses/expands, pushing content
                    sidebar.classList.toggle('collapsed');
                    body.classList.toggle('sidebar-collapsed-desktop');
                }
            }

            // Event listeners
            toggleSidebarBtn.addEventListener('click', toggleSidebar);

            sidebarBackdrop.addEventListener('click', () => {
                if (sidebar.classList.contains('show')) {
                    toggleSidebar(); // Close sidebar if backdrop is clicked (mobile)
                }
            });

            // Close sidebar if open on mobile when a link inside is clicked
            sidebar.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768 && sidebar.classList.contains('show')) {
                        toggleSidebar();
                    }
                });
            });

            // Adjust layout on window resize
            let isMobileView = window.innerWidth < 768;
            window.addEventListener('resize', function() {
                const newIsMobileView = window.innerWidth < 768;

                if (newIsMobileView !== isMobileView) {
                    // Viewport changed between mobile/desktop
                    if (newIsMobileView) {
                        // Switched to mobile view
                        sidebar.classList.remove('collapsed'); // Remove desktop collapsed state
                        body.classList.remove('sidebar-collapsed-desktop'); // Remove desktop padding state
                        if (sidebar.classList.contains('show')) {
                            body.style.overflow = 'hidden'; // Keep body hidden if sidebar was open on desktop
                        }
                    } else {
                        // Switched to desktop view
                        sidebar.classList.remove('show'); // Remove mobile show state
                        sidebarBackdrop.classList.remove('show'); // Remove backdrop
                        body.style.overflow = ''; // Allow body scroll
                        // Ensure sidebar is visible on desktop by default if not explicitly collapsed
                        if (!sidebar.classList.contains('collapsed')) {
                             body.classList.remove('sidebar-collapsed-desktop');
                        }
                    }
                    isMobileView = newIsMobileView;
                }
            });

            // Initialize sidebar state on page load based on screen size
            if (window.innerWidth < 768) {
                sidebar.classList.remove('collapsed'); // Ensure no desktop collapsed state on mobile
                body.classList.remove('sidebar-collapsed-desktop'); // Ensure no desktop padding on mobile
            }

            // Handle active link on load
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-nav a').forEach(link => {
                // Check if the link's href matches the current path,
                // accounting for potential trailing slashes
                const linkHref = link.getAttribute('href').endsWith('/') ? link.getAttribute('href') : link.getAttribute('href') + '/';
                const currentPathNormalized = currentPath.endsWith('/') ? currentPath : currentPath + '/';

                if (linkHref === currentPathNormalized) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }

            });
        });
    </script>

      <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- Stack for additional scripts (e.g., Midtrans, specific page JS) --}}
    @stack('scripts')
</body>
</html>