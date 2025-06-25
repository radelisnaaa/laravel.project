@extends('layouts.user-app')

@section('title', 'Dasbor Pengguna')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    {{-- Animate.css for subtle animations --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom styles for an enhanced dashboard, using variables from user-app layout */
        :root {
            --primary-color: #4CAF50; /* A pleasant green for primary actions/highlights */
            --primary-light: #66BB6A; /* Lighter shade of primary */
            --secondary-color: #6C757D; /* Muted grey for secondary text/borders */
            --accent-blue: #007BFF; /* A vibrant blue for info/links */
            --accent-red: #DC3545; /* Red for alerts/warnings */
            --accent-yellow: #FFC107; /* Yellow for history/warning */
            --light-bg: #F0F2F5; /* A slightly darker light background for more depth */
            --dark-text: #212529; /* Dark text for readability */
            --light-text: #FFFFFF; /* White text for dark backgrounds */
            --card-bg: #FFFFFF; /* White background for cards */
            --border-color: rgba(0, 0, 0, 0.1); /* Subtle border color */
            --shadow-light: rgba(0, 0, 0, 0.05); /* Light shadow for elements */
            --shadow-medium: rgba(0, 0, 0, 0.15); /* Medium shadow for hover effects */
        }

        body {
            background-color: var(--light-bg);
            color: var(--dark-text);
        }

        .dashboard-container {
            padding-left: 0;
            padding-right: 0;
        }

        .dashboard-card {
            border-radius: 1rem; /* Softer rounded corners */
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1; /* Ensure cards are above background effects if any */
        }

        .dashboard-card:hover {
            transform: translateY(-10px) scale(1.02); /* More pronounced lift and slight scale */
            box-shadow: 0 1.5rem 3rem var(--shadow-medium) !important; /* Stronger shadow on hover */
        }

        .dashboard-card-icon {
            transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
            color: var(--primary-color);
            font-size: 4rem; /* Larger icons */
            text-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle text shadow for depth */
        }

        .dashboard-card:hover .dashboard-card-icon {
            transform: scale(1.2); /* More pronounced scale */
            color: var(--accent-blue); /* Change icon color on hover for an interactive feel */
        }

        .card-header-custom {
            background-image: linear-gradient(to right, var(--primary-color), var(--primary-light));
            color: var(--light-text);
            border-bottom: none;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 2rem; /* More padding */
            font-size: 2rem; /* Larger header text */
            font-weight: 700;
            text-align: center;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.05em; /* Slightly more spaced letters */
        }

        /* Subtle pattern in header */
        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px; /* Larger pattern */
            opacity: 0.2;
            z-index: 0;
        }

        .card-header-custom h4 {
            z-index: 1; /* Ensure text is above pattern */
            position: relative;
        }

        /* Custom Alert Styling */
        .alert-custom {
            border-radius: 0.75rem;
            padding: 1.5rem; /* More padding */
            display: flex;
            align-items: center;
            font-size: 1.1rem; /* Slightly larger font */
            box-shadow: 0 0.25rem 0.75rem var(--shadow-light);
            border-left: 8px solid; /* Prominent left border */
        }

        .alert-success-custom {
            background-color: #D4EDDA;
            color: #155724;
            border-color: #28A745; /* Stronger green border */
        }

        .alert-info-custom {
            background-color: #D1ECF1;
            color: #0C5460;
            border-color: #17A2B8; /* Stronger blue border */
        }

        .alert-custom .btn-close {
            font-size: 1rem;
            padding: 0.75rem; /* Larger close button touch area */
        }
        .alert-custom i {
            margin-right: 1.25rem;
        }

        /* Dashboard Stats Section */
        .dashboard-stats .card-title {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.2rem; /* Slightly larger */
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }

        .dashboard-stats .display-4 {
            font-size: 4.5rem; /* Larger numbers */
            color: var(--dark-text);
            margin-bottom: 0.75rem;
            font-weight: 800; /* Bolder numbers */
        }

        .dashboard-stats .small {
            font-size: 0.95rem; /* Slightly larger */
            color: var(--secondary-color);
        }

        /* Responsive adjustments for cards */
        @media (max-width: 991.98px) { /* Adjust for medium and small screens */
            .dashboard-container {
                padding: 0 15px; /* Add some padding on smaller screens */
            }
            .dashboard-stats .col-md-4 {
                margin-bottom: 2.5rem; /* More space between cards on small/medium screens */
            }
            .dashboard-stats .col-md-4:last-child {
                margin-bottom: 0;
            }
            .dashboard-card-icon {
                font-size: 3.5rem;
            }
            .display-4 {
                font-size: 3.8rem !important;
            }
            .card-header-custom {
                font-size: 1.7rem;
                padding: 1.5rem;
            }
            .alert-custom {
                font-size: 1rem;
                padding: 1rem;
            }
        }

        @media (max-width: 575.98px) { /* Adjust for extra small screens */
            .dashboard-card-icon {
                font-size: 3rem;
            }
            .display-4 {
                font-size: 3rem !important;
            }
            .card-header-custom {
                font-size: 1.3rem;
                padding: 1rem;
            }
            .alert-custom {
                flex-direction: column; /* Stack alert content on very small screens */
                text-align: center;
            }
            .alert-custom i {
                margin-right: 0;
                margin-bottom: 0.75rem;
            }
            .alert-custom .btn-close {
                align-self: flex-end; /* Push close button to corner */
                margin-top: 0.5rem;
            }
        }


        /* Event Card Specific Styles */
        .event-card {
            border-radius: 0.75rem;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* For potential image */
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 0.8rem 1.8rem var(--shadow-medium) !important;
        }

        .event-card .card-img-top {
            height: 180px; /* Fixed height for event images */
            object-fit: cover; /* Cover the area */
            border-top-left-radius: 0.7rem;
            border-top-right-radius: 0.7rem;
        }

        .event-card .card-body {
            padding: 1.5rem;
        }

        .event-card .card-title {
            color: var(--primary-color);
            font-weight: 700; /* Bolder title */
            font-size: 1.4rem; /* Slightly larger title */
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }

        .event-card .card-text {
            font-size: 1rem;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .event-card .card-text i {
            color: var(--secondary-color);
            font-size: 1.1rem;
            margin-right: 0.75rem;
            width: 20px; /* Fixed width for consistent alignment */
        }

        .event-card .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.2s ease-in-out;
            border-radius: 0.5rem;
            padding: 0.75rem 1.2rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            margin-top: 1rem; /* More space from text */
        }

        .event-card .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--light-text);
            border-color: var(--primary-color);
            box-shadow: 0 0.4rem 1rem rgba(76, 175, 80, 0.3);
            transform: translateY(-2px); /* Slight button lift on hover */
        }


        /* FullCalendar specific styles */
        #calendar {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 2rem; /* More padding for calendar */
            box-shadow: 0 0.5rem 1.5rem var(--shadow-light);
            border: 1px solid var(--border-color);
        }

        .fc-toolbar-title {
            font-size: 2.2rem !important; /* Even larger calendar title */
            color: var(--dark-text);
            font-weight: 700;
            line-height: 1.2;
        }

        .fc-button-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: var(--light-text) !important;
            border-radius: 0.5rem !important;
            padding: 0.7rem 1.2rem !important;
            font-weight: 600;
            text-transform: capitalize;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .fc-button-primary:hover {
            background-color: var(--primary-light) !important;
            border-color: var(--primary-light) !important;
            box-shadow: 0 0.4rem 1rem rgba(76, 175, 80, 0.3);
            transform: translateY(-1px);
        }

        .fc-event {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
            border-radius: 0.35rem;
            padding: 4px 8px; /* Slightly more padding */
            font-size: 0.95em; /* Slightly larger font */
            color: white;
            opacity: 0.95; /* Less transparent */
            transition: opacity 0.2s ease-in-out, transform 0.1s ease-in-out;
            margin-bottom: 2px; /* Small gap between events */
            cursor: pointer;
        }
        .fc-event:hover {
            opacity: 1;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: translateY(-1px);
        }

        .fc-daygrid-event-dot {
            border-color: var(--light-text) !important;
            width: 8px; /* Larger dot */
            height: 8px;
        }

        /* Enhanced scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-light);
        }
    </style>
@endsection

@section('content')
<div class="container-fluid dashboard-container py-5"> {{-- Changed to container-fluid for full width --}}
    <div class="row justify-content-center">
        <div class="col-12"> {{-- Takes full width --}}
            <div class="card shadow-lg border-0 dashboard-card">
                <div class="card-header card-header-custom">
                    <h4 class="mb-0 text-white text-center animate__animated animate__fadeInDown">Selamat Datang di Dasbor Pengguna!</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success-custom alert-dismissible fade show mb-5 animate__animated animate__fadeIn" role="alert">
                            <i class="fas fa-check-circle me-3 fa-2x"></i> {{-- Larger icon for alerts --}}
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(isset($notifications) && count($notifications) > 0)
                        <div class="alert alert-info-custom alert-dismissible fade show mb-5 animate__animated animate__fadeIn" role="alert">
                            <i class="fas fa-bell me-3 fa-2x animate__animated animate__tada animate__infinite" style="--animate-duration: 3s;"></i> {{-- Add animation --}}
                            <div>Anda memiliki **{{ count($notifications) }}** notifikasi baru. <a href="#" class="alert-link fw-bold ms-2 text-decoration-none">Lihat semua notifikasi</a></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row text-center dashboard-stats mb-5 g-4">
                        <div class="col-lg-4 col-md-6 col-sm-12"> {{-- More flexible column sizing for better responsiveness --}}
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                                    <i class="fas fa-calendar-alt mb-3 dashboard-card-icon animate__animated animate__pulse animate__infinite" style="--animate-duration: 2s;"></i>
                                    <h5 class="card-title fw-bold text-muted">Event Diikuti</h5>
                                    <h2 class="display-4 fw-bolder text-dark animate__animated animate__bounceIn">{{ $eventCount }}</h2>
                                    <p class="text-muted small">Event yang telah Anda daftari</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                                    <i class="fas fa-ticket-alt mb-3 dashboard-card-icon" style="color: var(--accent-blue);"></i>
                                    <h5 class="card-title fw-bold text-muted">Pesanan Tiket</h5>
                                    <h2 class="display-4 fw-bolder text-dark animate__animated animate__bounceIn">{{ $orderCount }}</h2>
                                    <p class="text-muted small">Jumlah total pesanan tiket Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12"> {{-- Takes full width on smaller screens, allowing more space for history --}}
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                                    <i class="fas fa-history mb-3 dashboard-card-icon" style="color: var(--accent-yellow);"></i>
                                    <h5 class="card-title fw-bold text-muted">Riwayat Pembelian</h5>
                                    <h2 class="display-4 fw-bolder text-dark animate__animated animate__bounceIn">{{ $historyCount }}</h2>
                                    <p class="text-muted small">Jumlah semua pembelian Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 border-2 opacity-75 animate__animated animate__fadeIn">

                    <div class="mt-5">
                        <h4 class="mb-4 text-primary d-flex align-items-center animate__animated animate__fadeInLeft">
                            <i class="fas fa-lightbulb me-3 fa-lg"></i> Rekomendasi Event Menarik untuk Anda
                        </h4>
                        @if($recommendedEvents->isNotEmpty())
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach($recommendedEvents as $event)
                                    <div class="col animate__animated animate__fadeInUp">
                                        <div class="card h-100 shadow-sm border-0 event-card">
                                            @if($event->image_url) {{-- Assuming you have an image_url attribute --}}
                                                <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}">
                                            @else
                                                <img src="https://via.placeholder.com/400x180?text=Event+Image" class="card-img-top" alt="Placeholder Event Image">
                                            @endif
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title mb-2">{{ $event->title }}</h5>
                                                <p class="card-text text-muted">
                                                    <i class="fas fa-calendar-day"></i> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                                                </p>
                                                @if($event->location)
                                                    <p class="card-text text-muted mb-3">
                                                        <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                                                    </p>
                                                @endif
                                                <div class="mt-auto pt-3">
                                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary w-100 animate__animated animate__pulse animate__infinite" style="--animate-duration: 4s;">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info-custom mt-3 text-center py-4 animate__animated animate__fadeIn">
                                <i class="fas fa-info-circle me-2 fa-lg"></i> Tidak ada rekomendasi event saat ini. Cek kembali nanti untuk event terbaru!
                            </div>
                        @endif
                    </div>

                    <hr class="my-5 border-2 opacity-75 animate__animated animate__fadeIn">

                    <div class="mt-5">
                        <h4 class="mb-4 text-primary d-flex align-items-center animate__animated animate__fadeInLeft">
                            <i class="fas fa-calendar-check me-3 fa-lg"></i> Jadwal Event Anda
                        </h4>
                        <div id="calendar" class="animate__animated animate__fadeInUp"></div>
                    </div>

                    <hr class="my-5 border-2 opacity-75 animate__animated animate__fadeIn">

                    {{-- NEW SECTION: Quick Actions / Shortcuts --}}
                    <div class="mt-5">
                        <h4 class="mb-4 text-primary d-flex align-items-center animate__animated animate__fadeInLeft">
                            <i class="fas fa-bolt me-3 fa-lg"></i> Akses Cepat
                        </h4>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            <div class="col animate__animated animate__zoomIn">
                                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm dashboard-card d-flex align-items-center justify-content-center p-4 text-center">
                                        <i class="fas fa-shopping-cart fa-3x mb-3 text-success"></i>
                                        <h6 class="fw-bold mb-0">Kelola Pesanan</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col animate__animated animate__zoomIn animate__delay-1s">
                                <a href="{{ route('events.index') }}" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm dashboard-card d-flex align-items-center justify-content-center p-4 text-center">
                                        <i class="fas fa-search fa-3x mb-3 text-info"></i>
                                        <h6 class="fw-bold mb-0">Cari Event Lain</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col animate__animated animate__zoomIn animate__delay-2s">
                                <a href="{{ route('user.profile.edit') }}" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm dashboard-card d-flex align-items-center justify-content-center p-4 text-center">
                                        <i class="fas fa-user-cog fa-3x mb-3 text-warning"></i>
                                        <h6 class="fw-bold mb-0">Edit Profil</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col animate__animated animate__zoomIn animate__delay-3s">
                                <a href="{{ route('support.index') }}" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm dashboard-card d-flex align-items-center justify-content-center p-4 text-center">
                                        <i class="fas fa-headset fa-3x mb-3 text-danger"></i>
                                        <h6 class="fw-bold mb-0">Dukungan & Bantuan</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/id.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                locale: 'id', // Set locale to Indonesian
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today:    'Hari Ini',
                    month:    'Bulan',
                    week:     'Minggu',
                    day:      'Hari'
                },
                events: [
                    @foreach($recommendedEvents as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->date }}',
                        url: '{{ route('events.show', $event->id) }}',
                        color: 'var(--accent-blue)' // Use CSS variable for event background
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                },
                eventDidMount: function(info) {
                    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                        new bootstrap.Tooltip(info.el, {
                            title: info.event.title + ' - ' + new Date(info.event.start).toLocaleDateString('id-ID', {
                                day: 'numeric', month: 'long', year: 'numeric'
                            }),
                            placement: 'top',
                            trigger: 'hover',
                            container: 'body'
                        });
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection