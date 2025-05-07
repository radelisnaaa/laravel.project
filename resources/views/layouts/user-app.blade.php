<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Pengguna')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* Palet Warna yang Diselaraskan */
        :root {
            --body-bg: #e0f7fa;
            --sidebar-bg: #1e88e5;
            --sidebar-text: #fff;
            --sidebar-hover: #1565c0;
            --active-bg: #bbdefb;
            --active-text: #1976d2;
            --content-bg: #fff;
            --text-primary: #444;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
            background-color: var(--body-bg);
            margin: 0;
            padding-left: var(--sidebar-width); /* Ruang awal untuk sidebar */
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
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Jika konten sidebar melebihi tinggi layar */
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.toggled {
            transform: translateX(-100%);
        }

        .sidebar h4 {
            padding: 20px 0;
            text-align: center;
            font-weight: bold;
            color: var(--sidebar-text);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        .sidebar a {
            color: var(--sidebar-text);
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out, padding-left 0.2s ease-in-out;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            padding-left: 25px;
        }

        .sidebar a.active {
            background-color: var(--active-bg);
            color: var(--active-text);
            border-left: 5px solid var(--active-text);
            padding-left: 15px;
            font-weight: 500;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: var(--content-bg);
            transition: margin-left 0.3s ease-in-out; /* Untuk jaga-jaga, meskipun kita pakai padding */
        }

        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.2em;
            padding: 10px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 101;
            display: none; /* Sembunyikan di layar besar */
        }

        .toggle-sidebar-btn:focus {
            outline: none;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0; /* Tidak ada padding di awal layar kecil */
            }
            .sidebar {
                transform: translateX(-100%); /* Sembunyikan sidebar di awal */
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.toggled {
                transform: translateX(0); /* Tampilkan sidebar */
            }
            .content {
                padding-top: 60px; /* Ruang agar konten tidak tertutup tombol toggle */
            }
            .toggle-sidebar-btn {
                display: block; /* Tampilkan tombol toggle */
            }
        }
    </style>
</head>
<body>

    <button class="toggle-sidebar-btn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">
        <h4 class="text-center py-4">MyEvent</h4>

        <a href="{{ route('user.dashboard') }}" class="{{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dasbor
        </a>

        <a href="{{ route('user.profile') }}" class="{{ Request::routeIs('user.profile') ? 'active' : '' }}">
            <i class="fas fa-user me-2"></i> Profil
        </a>

        <a href="{{ route('user.profile.history') }}" class="{{ Request::routeIs('user.profile.history') ? 'active' : '' }}">
            <i class="fas fa-history me-2"></i> Riwayat
        </a>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Keluar
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="content">
        @yield('content')
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