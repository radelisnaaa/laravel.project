@extends('layouts.user-app')

@section('title', 'Dasbor Pengguna')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    {{-- Animate.css for subtle animations --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        /* Custom styles with blue color scheme */
        :root {
            --primary-color: #3498db; /* Primary blue */
            --primary-light: #5dade2; /* Lighter blue */
            --primary-dark: #2874a6; /* Darker blue */
            --secondary-color: #7f8c8d; /* Muted grey */
            --accent-blue: #2980b9; /* Vibrant blue */
            --accent-red: #e74c3c; /* Red for alerts */
            --accent-yellow: #f39c12; /* Yellow for history */
            --light-bg: #f8f9fa; /* Light background */
            --dark-text: #2c3e50; /* Dark text */
            --light-text: #ffffff; /* White text */
            --card-bg: #ffffff; /* Card background */
            --border-color: rgba(0, 0, 0, 0.1); /* Border color */
            --shadow-light: rgba(0, 0, 0, 0.05); /* Light shadow */
            --shadow-medium: rgba(0, 0, 0, 0.15); /* Medium shadow */
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
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem var(--shadow-medium) !important;
        }

        .dashboard-card-icon {
            transition: transform 0.3s ease;
            color: var(--primary-color);
            font-size: 3.5rem;
        }

        .dashboard-card:hover .dashboard-card-icon {
            transform: scale(1.1);
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--light-text);
            border-bottom: none;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 15px 15px;
            opacity: 0.2;
            z-index: 0;
        }

        .card-header-custom h4 {
            z-index: 1;
            position: relative;
        }

        /* Alert Styling */
        .alert-custom {
            border-radius: 0.5rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            box-shadow: 0 0.25rem 0.5rem var(--shadow-light);
            border-left: 5px solid;
        }

        .alert-success-custom {
            background-color: #d4f1f9;
            color: #0c5460;
            border-color: var(--accent-blue);
        }

        .alert-info-custom {
            background-color: #e2e3e5;
            color: #383d41;
            border-color: var(--secondary-color);
        }

        /* Stats Section */
        .dashboard-stats .card-title {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .dashboard-stats .display-4 {
            font-size: 3rem;
            color: var(--dark-text);
            font-weight: 700;
        }

        /* Event Cards */
        .event-card {
            border-radius: 0.5rem;
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-card .card-img-top {
            height: 160px;
            object-fit: cover;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .event-card .card-title {
            color: var(--primary-dark);
            font-weight: 600;
        }

        /* Calendar */
        #calendar {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            padding: 1rem;
            border: 1px solid var(--border-color);
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            color: var(--dark-text);
        }

        .fc-button-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 1199.98px) {
            .dashboard-stats .display-4 {
                font-size: 2.5rem;
            }
            .card-header-custom {
                font-size: 1.5rem;
                padding: 1.25rem;
            }
        }

        @media (max-width: 991.98px) {
            .dashboard-stats .col-md-4 {
                margin-bottom: 1.5rem;
            }
            .dashboard-card-icon {
                font-size: 3rem;
            }
            .display-4 {
                font-size: 2.25rem !important;
            }
        }

        @media (max-width: 767.98px) {
            .dashboard-container {
                padding: 0 15px;
            }
            .card-header-custom {
                font-size: 1.25rem;
                padding: 1rem;
            }
            .event-card .card-img-top {
                height: 140px;
            }
        }

        @media (max-width: 575.98px) {
            .dashboard-stats .display-4 {
                font-size: 2rem !important;
            }
            .alert-custom {
                flex-direction: column;
                text-align: center;
            }
            .alert-custom i {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }
        }

        /* Quick Actions */
        .quick-action-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            height: 100%;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1) !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid dashboard-container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-0 dashboard-card">
                <div class="card-header card-header-custom">
                    <h4 class="mb-0 text-white text-center">Selamat Datang di Dasbor Pengguna!</h4>
                </div>
                <div class="card-body p-3 p-md-4">
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
                            <div>Anda memiliki <strong>{{ count($notifications) }}</strong> notifikasi baru. <a href="#" class="text-primary fw-bold ms-1">Lihat semua</a></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row dashboard-stats mb-4 g-3">
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-calendar-alt mb-2 dashboard-card-icon"></i>
                                    <h5 class="card-title">Event Diikuti</h5>
                                    <h2 class="display-4">{{ $eventCount }}</h2>
                                    <p class="text-muted small">Total event yang diikuti</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-ticket-alt mb-2 dashboard-card-icon"></i>
                                    <h5 class="card-title">Pesanan Tiket</h5>
                                    <h2 class="display-4">{{ $orderCount }}</h2>
                                    <p class="text-muted small">Total pesanan tiket</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="card border-0 shadow-sm dashboard-card h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-history mb-2 dashboard-card-icon"></i>
                                    <h5 class="card-title">Riwayat Pembelian</h5>
                                    <h2 class="display-4">{{ $historyCount }}</h2>
                                    <p class="text-muted small">Total transaksi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-4">
                        <h4 class="mb-3 text-primary">
                            <i class="fas fa-lightbulb me-2"></i> Rekomendasi Event
                        </h4>
                        @if($recommendedEvents->isNotEmpty())
                            <div class="row g-3">
                                @foreach($recommendedEvents as $event)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card h-100 shadow-sm border-0 event-card">
                                            <img src="{{ $event->image_url ?? 'https://via.placeholder.com/400x180?text=Event+Image' }}" class="card-img-top" alt="{{ $event->title }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $event->title }}</h5>
                                                <p class="card-text text-muted small">
                                                    <i class="fas fa-calendar-day me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                                                </p>
                                                @if($event->location)
                                                    <p class="card-text text-muted small">
                                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                                                    </p>
                                                @endif
                                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-primary mt-2 w-100">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info-custom text-center py-3">
                                <i class="fas fa-info-circle me-2"></i> Tidak ada rekomendasi event saat ini.
                            </div>
                        @endif
                    </div>

                    <div class="my-4">
                        <h4 class="mb-3 text-primary">
                            <i class="fas fa-calendar-check me-2"></i> Jadwal Event
                        </h4>
                        <div id="calendar"></div>
                    </div>

                    <div class="my-4">
                        <h4 class="mb-3 text-primary">
                            <i class="fas fa-bolt me-2"></i> Akses Cepat
                        </h4>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                                    <div class="card quick-action-card h-100 text-center p-3">
                                        <i class="fas fa-shopping-cart fa-2x mb-2 text-primary"></i>
                                        <h6 class="mb-0">Pesanan Saya</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('events.index') }}" class="text-decoration-none">
                                    <div class="card quick-action-card h-100 text-center p-3">
                                        <i class="fas fa-search fa-2x mb-2 text-primary"></i>
                                        <h6 class="mb-0">Cari Event</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="{{ route('user.profile.edit') }}" class="text-decoration-none">
                                    <div class="card quick-action-card h-100 text-center p-3">
                                        <i class="fas fa-user-cog fa-2x mb-2 text-primary"></i>
                                        <h6 class="mb-0">Profil</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card quick-action-card h-100 text-center p-3">
                                        <i class="fas fa-headset fa-2x mb-2 text-primary"></i>
                                        <h6 class="mb-0">Bantuan</h6>
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
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari'
                },
                events: [
                    @foreach($recommendedEvents as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->date }}',
                        url: '{{ route('events.show', $event->id) }}',
                        color: 'var(--primary-color)'
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection