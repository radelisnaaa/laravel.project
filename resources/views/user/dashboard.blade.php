@extends('layouts.user-app')

@section('title', 'Dasbor Pengguna')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <style>
        /* Custom styles for an enhanced dashboard, using variables from user-app layout */
        .dashboard-card {
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: var(--content-bg); /* Use content background for cards */
            border: 1px solid rgba(0, 0, 0, 0.08); /* Subtle border */
        }

        .dashboard-card:hover {
            transform: translateY(-8px); /* More pronounced lift */
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2) !important; /* Stronger shadow on hover */
        }

        .dashboard-card-icon {
            transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
            color: var(--sidebar-bg); /* Use sidebar background for main icon color */
        }

        .dashboard-card:hover .dashboard-card-icon {
            transform: scale(1.15); /* Slightly larger scale */
            color: var(--sidebar-hover); /* Darken icon color on hover */
        }

        .card-header-custom {
            background-image: linear-gradient(to right, var(--sidebar-bg), var(--sidebar-hover)); /* Use sidebar colors for gradient */
            color: var(--sidebar-text); /* White text from sidebar */
            border-bottom: none;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            padding: 1.5rem;
            font-size: 1.6rem; /* Larger header text */
            font-weight: 700;
        }

        /* Custom Alert Styling (from user-app layout) */
        .alert-custom {
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .alert-success-custom {
            background-color: #d4edda; /* Light green */
            color: #155724; /* Dark green text */
            border-color: #c3e6cb; /* Green border */
        }

        .alert-info-custom {
            background-color: #d1ecf1; /* Light blue */
            color: #0c5460; /* Dark blue text */
            border-color: #bee5eb; /* Blue border */
        }

        /* Responsive adjustments for cards */
        @media (max-width: 767.98px) {
            .dashboard-stats .col-md-4 {
                margin-bottom: 1.5rem; /* Add space between cards on small screens */
            }
        }

        .event-card {
            border-radius: 0.75rem;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background-color: var(--content-bg);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .event-card:hover {
            transform: translateY(-5px); /* Moderate lift */
            box-shadow: 0 0.8rem 1.5rem rgba(0, 0, 0, 0.12) !important; /* Moderate shadow on hover */
        }

        .event-card .card-title {
            color: var(--brand-color); /* Use brand color for event titles for consistency */
            font-weight: 600;
        }

        .event-card .card-text i {
            color: var(--text-primary); /* Use primary text color for muted icons */
        }

        .event-card .btn-outline-primary {
            color: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
            transition: all 0.2s ease-in-out;
        }

        .event-card .btn-outline-primary:hover {
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            border-color: var(--sidebar-hover);
        }


        /* FullCalendar specific styles (from user-app layout) */
        #calendar {
            background-color: var(--content-bg);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.08); /* Consistent border */
        }

        .fc-toolbar-title {
            font-size: 1.75rem !important;
            color: var(--text-primary); /* Use primary text color for calendar title */
            font-weight: 600;
        }

        .fc-button-primary {
            background-color: var(--sidebar-bg) !important;
            border-color: var(--sidebar-bg) !important;
            color: var(--sidebar-text) !important; /* Ensure white text on buttons */
        }
        .fc-button-primary:hover {
            background-color: var(--sidebar-hover) !important;
            border-color: var(--sidebar-hover) !important;
        }
        .fc-event {
            background-color: var(--accent-green); /* Success color for event markers */
            border-color: var(--accent-green);
            border-radius: 0.25rem;
            padding: 2px 5px;
            font-size: 0.85em;
            color: white; /* Ensure event text is readable */
        }
    </style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9"> {{-- Max width for better readability on large screens --}}
            <div class="card shadow-lg border-0 dashboard-card">
                <div class="card-header card-header-custom">
                    <h4 class="mb-0 text-center">Dasbor Pengguna</h4>
                </div>
                <div class="card-body p-4 p-md-5"> {{-- More padding for larger screens --}}
                    @if(session('success'))
                        <div class="alert alert-success-custom alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(isset($notifications) && count($notifications) > 0)
                        <div class="alert alert-info-custom alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-bell me-2"></i>
                            <div>Anda memiliki {{ count($notifications) }} notifikasi baru.</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row text-center dashboard-stats mb-5">
                        <div class="col-md-4 mb-4 mb-md-0"> {{-- Add mb-4 for spacing on smaller screens --}}
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                                    <i class="fas fa-calendar-check fa-3x mb-3 dashboard-card-icon"></i>
                                    <h5 class="card-title text-muted fw-bold">Jumlah Event</h5>
                                    <h2 class="display-4 fw-bolder text-dark">{{ $eventCount }}</h2>
                                    <p class="text-muted small">Event yang Anda ikuti</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4 mb-md-0">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                                    <i class="fas fa-ticket-alt fa-3x mb-3 dashboard-card-icon" style="color: var(--accent-green);"></i> {{-- Explicit color for success icon --}}
                                    <h5 class="card-title text-muted fw-bold">Pesanan Tiket</h5>
                                    <h2 class="display-4 fw-bolder text-dark">{{ $orderCount }}</h2>
                                    <p class="text-muted small">Total pesanan tiket Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                                    <i class="fas fa-history fa-3x mb-3 dashboard-card-icon" style="color: var(--active-text);"></i> {{-- Using active-text for history icon --}}
                                    <h5 class="card-title text-muted fw-bold">Riwayat Pembelian</h5>
                                    <h2 class="display-4 fw-bolder text-dark">{{ $historyCount }}</h2>
                                    <p class="text-muted small">Jumlah pembelian Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="mt-5">
                        <h5 class="mb-4 text-primary d-flex align-items-center">
                            <i class="fas fa-star me-2"></i> Rekomendasi Event untuk Anda
                        </h5>
                        @if($recommendedEvents->isNotEmpty())
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach($recommendedEvents as $event)
                                    <div class="col">
                                        <div class="card h-100 shadow-sm border-0 event-card">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title mb-2">{{ $event->title }}</h5>
                                                <p class="card-text text-muted mb-2 small">
                                                    <i class="fas fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                                                </p>
                                                @if($event->location)
                                                    <p class="card-text text-muted mb-3 small">
                                                        <i class="fas fa-map-marker-alt me-2"></i> {{ $event->location }}
                                                    </p>
                                                @endif
                                                <div class="mt-auto pt-3"> {{-- Pushes the button to the bottom, add padding-top --}}
                                                    <a href="{{ route('user.events.show', $event->id) }}" class="btn btn-sm btn-outline-primary w-100">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info-custom mt-3 text-center">
                                <i class="fas fa-info-circle me-2"></i> Tidak ada rekomendasi event saat ini. Cek kembali nanti!
                            </div>
                        @endif
                    </div>

                    <hr class="my-5">

                    <div class="mt-5">
                        <h5 class="mb-4 text-primary d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2"></i> Kalender Event
                        </h5>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales-all.min.js'></script> {{-- For localization --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto', // Adjust height automatically
                locale: 'id', // Set locale to Indonesian
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // Removed 'listDay' as it's not standard in this version
                },
                buttonText: {
                    today:    'Hari Ini',
                    month:    'Bulan',
                    week:     'Minggu',
                    day:      'Hari',
                    list:     'Daftar' // If you want to use a list view, ensure you import the list plugin
                },
                events: [
                    @foreach($recommendedEvents as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->date }}',
                        url: '{{ route('events.show', $event->id) }}',
                        color: 'var(--accent-green)' // Use CSS variable for event background
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Prevent default link behavior
                    if (info.event.url) {
                        window.open(info.event.url, '_blank'); // Open event URL in a new tab
                    }
                },
                eventDidMount: function(info) {
                    // Initialize Bootstrap Tooltip for event details on hover
                    // Ensure Bootstrap's JS is loaded before this script runs
                    new bootstrap.Tooltip(info.el, {
                        title: info.event.title + ' - ' + new Date(info.event.start).toLocaleDateString('id-ID', {
                            day: 'numeric', month: 'long', year: 'numeric'
                        }),
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            calendar.render();
        });
    </script>
@endsection