@extends('layouts.admin-app')

@section('title', 'Dasbor Admin')
@section('title-content', 'Dasbor Admin')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* Color Variables */
    :root {
        --primary-color: #007bff; /* Bootstrap primary blue */
        --blue-light: #339CFF;    /* Custom light blue for orders */
        --secondary-color: #6c757d; /* Bootstrap secondary grey */
        --info-color: #17a2b8;    /* Bootstrap info teal */
        --warning-color: #ffc107; /* Bootstrap warning yellow */
        --danger-color: #dc3545;  /* Bootstrap danger red */
        --light-bg: #f0f2f5;      /* Lighter, softer background for the page */
        --card-bg: #ffffff;      /* White background for cards */
        --shadow-light: rgba(0, 0, 0, 0.08); /* Initial subtle shadow */
        --shadow-hover: rgba(0, 0, 0, 0.2);  /* Stronger shadow on hover */
        --dark-text: #343a40;     /* Darker text for readability */
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Poppins', sans-serif; /* A modern, clean font */
    }

    /* Alerts Styling */
    .alert {
        border-radius: 0.75rem; /* More rounded alerts */
        font-weight: 500;
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem; /* More padding */
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1); /* Subtle shadow for alerts */
    }

    .alert-success {
        background-color: #e6f7ff; /* Light blue success background */
        color: #0056b3;           /* Darker blue text */
        border-color: #b3d9ff;    /* Border to match */
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    /* Stats Card Styling */
    .stats-card {
        border-radius: 1.25rem; /* Even more rounded corners */
        overflow: hidden;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        background-color: var(--card-bg);
        border: none;
        box-shadow: 0 0.75rem 2rem var(--shadow-light); /* Initial subtle shadow */
        height: 100%; /* Ensure uniform height for all cards */
        display: flex;
        flex-direction: column; /* Allows content to push button to bottom */
        justify-content: space-between; /* Distribute space */
    }

    .stats-card:hover {
        transform: translateY(-10px) scale(1.02); /* More pronounced lift and slight scale */
        box-shadow: 0 1rem 3rem var(--shadow-hover); /* Deeper shadow on hover */
    }

    .stats-card .card-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        animation: fadeInUp 0.7s ease-in-out; /* Slightly longer animation */
    }

    .stats-icon {
        font-size: 4rem; /* Even larger icons */
        margin-bottom: 1.25rem; /* More space below icon */
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55), color 0.3s ease-in-out; /* Bouncier transition */
        animation: pulse 2s infinite ease-in-out; /* Gentle pulse animation */
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.2) rotate(8deg); /* More aggressive icon animation on hover */
    }

    .card-title {
        font-size: 2.2rem; /* Larger title for count */
        font-weight: 800; /* Bolder */
        color: var(--dark-text);
        margin-bottom: 0.75rem;
        letter-spacing: -0.05rem; /* Slightly tighter letter spacing */
    }

    .card-subtitle {
        font-size: 1.1rem; /* Slightly larger subtitle */
        color: var(--secondary-color);
        margin-bottom: 2rem; /* More space before button */
    }

    .stats-card .btn {
        font-weight: 700; /* Bolder button text */
        padding: 0.8rem 2rem; /* Larger button padding */
        border-radius: 0.75rem; /* More rounded buttons */
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Bouncy button transition */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for buttons */
        margin-top: auto; /* Push button to the bottom */
    }

    /* Specific Icon Colors (Ensure they are distinct) */
    .text-primary { color: var(--primary-color) !important; }
    .text-blue-light { color: var(--blue-light) !important; }
    .text-info { color: var(--info-color) !important; }
    .text-warning { color: var(--warning-color) !important; }

    /* Button specific styles and hover effects */
    .btn-outline-primary { border-color: var(--primary-color); color: var(--primary-color); }
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.4);
        transform: translateY(-2px);
    }

    .btn-outline-blue-light { border-color: var(--blue-light); color: var(--blue-light); }
    .btn-outline-blue-light:hover {
        background-color: var(--blue-light);
        color: white;
        box-shadow: 0 6px 16px rgba(51, 156, 255, 0.4);
        transform: translateY(-2px);
    }

    .btn-outline-info { border-color: var(--info-color); color: var(--info-color); }
    .btn-outline-info:hover {
        background-color: var(--info-color);
        color: white;
        box-shadow: 0 6px 16px rgba(23, 162, 184, 0.4);
        transform: translateY(-2px);
    }

    .btn-outline-warning { border-color: var(--warning-color); color: var(--warning-color); }
    .btn-outline-warning:hover {
        background-color: var(--warning-color);
        color: white;
        box-shadow: 0 6px 16px rgba(255, 193, 7, 0.4);
        transform: translateY(-2px);
    }

    /* Keyframe animations */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) { /* Lg devices and down */
        .stats-card .card-body {
            padding: 1.5rem;
        }
        .stats-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }
        .card-title {
            font-size: 1.9rem;
        }
        .card-subtitle {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .stats-card .btn {
            padding: 0.7rem 1.8rem;
        }
    }

    @media (max-width: 767.98px) { /* Md devices and down */
        .stats-card {
            margin-bottom: 1rem; /* Add some margin between cards in stacked view */
        }
        .stats-card .card-body {
            padding: 1.25rem;
        }
        .stats-icon {
            font-size: 3rem;
            margin-bottom: 0.75rem;
        }
        .card-title {
            font-size: 1.6rem;
        }
        .card-subtitle {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .stats-card .btn {
            width: auto; /* Allow buttons to size naturally again */
            padding: 0.6rem 1.5rem;
        }
    }

    @media (max-width: 575.98px) { /* Sm devices and down */
        .stats-icon { font-size: 2.8rem; margin-bottom: 0.5rem; }
        .card-title { font-size: 1.4rem; }
        .card-subtitle { font-size: 0.85rem; margin-bottom: 0.75rem; }
        .stats-card .btn { width: 100%; font-size: 0.9rem; } /* Full width buttons on very small screens */
        .alert { padding: 0.75rem 1rem; font-size: 0.9rem; }
    }
</style>
@endsection

@section('content')
    {{-- Success/Error Alerts --}}
    @if (session('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger animate__animated animate__fadeInDown mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 mt-4">
        {{-- Event Card --}}
        <div class="col">
            <div class="card stats-card animate__animated animate__fadeInUp">
                <div class="card-body">
                    <i class="fas fa-calendar-alt stats-icon text-primary"></i>
                    <h5 class="card-title">{{ number_format($events->count() ?? 0) }}</h5> {{-- Changed to count() for collections --}}
                    <h6 class="card-subtitle">Total Event</h6>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">Kelola Event <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        {{-- Orders Card --}}
        <div class="col">
            <div class="card stats-card animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card-body">
                    <i class="fas fa-shopping-cart stats-icon text-blue-light"></i>
                    <h5 class="card-title">{{ number_format($orders->count() ?? 0) }}</h5> {{-- Changed to count() for collections --}}
                    <h6 class="card-subtitle">Total Pesanan</h6>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-blue-light">Kelola Pesanan <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        {{-- Users Card --}}
        <div class="col">
            <div class="card stats-card animate__animated animate__fadeInUp animate__delay-2s">
                <div class="card-body">
                    <i class="fas fa-users stats-icon text-info"></i>
                    <h5 class="card-title">{{ number_format($users->count() ?? 0) }}</h5> {{-- Changed to count() for collections --}}
                    <h6 class="card-subtitle">Total Pengguna</h6>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-info">Kelola Pengguna <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>

        {{-- Tickets Card --}}
        <div class="col">
            <div class="card stats-card animate__animated animate__fadeInUp animate__delay-3s">
                <div class="card-body">
                    <i class="fas fa-ticket-alt stats-icon text-warning"></i>
                    <h5 class="card-title">{{ number_format($tickets->count() ?? 0) }}</h5> {{-- Changed to count() for collections --}}
                    <h6 class="card-subtitle">Total Tiket</h6>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-warning">Kelola Tiket <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection