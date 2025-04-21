<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .dashboard-title {
            color: #1e88e5;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2.5em;
        }

        .section-title {
            color: #1e88e5;
            border-bottom: 2px solid #bbdefb;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.8em;
        }

        .event-card {
            background-color: #f9fbe7;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #1e88e5;
        }

        .event-card h5 {
            color: #333;
            margin-bottom: 10px;
        }

        .event-card p {
            color: #555;
            margin-bottom: 8px;
        }

        .btn-primary-dash {
            background-color: #1e88e5;
            border-color: #1e88e5;
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-dash:hover {
            background-color: #1565c0;
            border-color: #1565c0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-secondary-dash {
            border-color: #78909c;
            color: #78909c;
            border-radius: 8px;
            padding: 8px 12px;
            text-decoration: none;
            transition: border-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-secondary-dash:hover {
            border-color: #546e7a;
            color: #546e7a;
        }

        .notification-item {
            background-color: #f0f8ea;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 3px solid #8bc34a;
        }

        .notification-item small {
            color: #777;
        }

        .profile-info p {
            color: #555;
            margin-bottom: 8px;
        }

        .profile-actions a {
            margin-right: 10px;
        }

        .calendar-container {
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
        }

        #eventCalendar {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="dashboard-title"><i class="fas fa-tachometer-alt me-2"></i> Dashboard Pengguna</h1>

    <div class="row">
        <div class="col-md-8">
            <section>
                <h2 class="section-title"><i class="fas fa-calendar-check me-2"></i> Event Saya</h2>
                @if ($myEvents->isNotEmpty())
                    @foreach ($myEvents as $event)
                        <div class="event-card">
                            <h5>{{ $event->name }}</h5>
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}

                            <p><i class="fas fa-tag me-1"></i> Tiket: {{ $event->ticketType }}</p>
                            <p><i class="fas fa-info-circle me-1"></i> Status: {{ $event->status }}</p>
                            <a href="{{ route('user.events.show', $event->id) }}" class="btn btn-sm btn-outline-secondary-dash"><i class="fas fa-eye me-1"></i> Detail</a>
                            @if ($event->isOngoing())
                                <a href="{{ $event->zoom_link }}" class="btn btn-sm btn-success ms-2" target="_blank"><i class="fas fa-video me-1"></i> Gabung Sekarang</a>
                            @endif
                            @if ($event->isFinished())
                                <button class="btn btn-sm btn-secondary ms-2" disabled><i class="fas fa-check-circle me-1"></i> Selesai</button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p>Anda belum mengikuti event apapun.</p>
                @endif
            </section>

            <section class="mt-4">
                <h2 class="section-title"><i class="fas fa-compass me-2"></i> Jelajahi Event Lain</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @if ($recommendedEvents->isNotEmpty())
                        @foreach ($recommendedEvents as $event)
                            <div class="col">
                                <div class="event-card">
                                    <h5>{{ $event->name }}</h5>
                                    <p><i class="fas fa-calendar-alt me-1"></i> Tanggal: {{ $event->date->format('d F Y') }}</p>
                                    <p><i class="fas fa-user-tie me-1"></i> Pembicara: {{ $event->speaker }}</p>
                                    <a href="{{ route('public.events.show', $event->id) }}" class="btn btn-sm btn-outline-secondary-dash"><i class="fas fa-info-circle me-1"></i> Detail</a>
                                    <button class="btn btn-sm btn-outline-warning ms-2"><i class="fas fa-heart me-1"></i> Simpan</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Tidak ada rekomendasi event saat ini.</p>
                    @endif
                </div>
            </section>
        </div>

        <div class="col-md-4">
            <section>
                <h2 class="section-title"><i class="fas fa-user-circle me-2"></i> Akses Profil</h2>
                <div class="card p-3">
                    <p class="text-muted"><i class="fas fa-info-circle me-1"></i> Kelola informasi profil Anda di sini.</p>
                    <div class="profile-actions mt-3">
                        <a href="{{ route('user.profile.index') }}" class="btn btn-sm btn-primary-dash"><i class="fas fa-user me-1"></i> Lihat Profil</a>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-sm btn-outline-secondary-dash"><i class="fas fa-edit me-1"></i> Edit Profil</a>
                        <a href="{{ route('user.profile.history') }}" class="btn btn-sm btn-outline-secondary-dash"><i class="fas fa-history me-1"></i> Riwayat Pembelian</a>
                    </div>
                </div>
            </section>

            <section class="mt-4">
                <h2 class="section-title"><i class="fas fa-bell me-2"></i> Notifikasi</h2>
                @forelse ($notifications as $notif)
                    <div class="notification-item d-flex justify-content-between align-items-start">
                        <div>
                            <p class="{{ $notif->is_read ? 'text-muted' : '' }}">{{ $notif->message }}</p>
                            <small><i class="fas fa-clock me-1"></i> {{ $notif->created_at->diffForHumans() }}</small>
                        </div>
                        @if (! $notif->is_read)
                            <form action="{{ route('user.notifications.read', $notif->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-outline-success ms-2"><i class="fas fa-check me-1"></i> Tandai Dibaca</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p>Tidak ada notifikasi baru.</p>
                @endforelse
            </section>

            <section class="mt-4">
                <h2 class="section-title"><i class="fas fa-calendar-alt me-2"></i> Kalender Event</h2>
                <div class="calendar-container">
                    <div id="eventCalendar"></div>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('eventCalendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($calendarEvents),
            eventColor: '#1e88e5',
            height: 'auto'
        });
        calendar.render();
    });
</script>
</body>
</html>
