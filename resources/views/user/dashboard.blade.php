@extends('layouts.user-app')

@section('title', 'Dashboard User')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Dasbor</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(isset($notifications) && count($notifications) > 0)
                        <div class="alert alert-info">
                            <i class="fas fa-bell me-2"></i> Anda memiliki {{ count($notifications) }} notifikasi baru.
                        </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm hover-shadow transition h-100">
                                <div class="card-body">
                                    <i class="fas fa-calendar-check fa-2x text-info mb-3 transition-scale"></i>
                                    <h5 class="card-title">Jumlah Event</h5>
                                    <h3>{{ $eventCount }}</h3>
                                    <p class="text-muted small">Event yang Anda ikuti</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm hover-shadow transition h-100">
                                <div class="card-body">
                                    <i class="fas fa-ticket-alt fa-2x text-success mb-3 transition-scale"></i>
                                    <h5 class="card-title">Pesanan Tiket</h5>
                                    <h3>{{ $orderCount }}</h3>
                                    <p class="text-muted small">Total pesanan tiket Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm hover-shadow transition h-100">
                                <div class="card-body">
                                    <i class="fas fa-history fa-2x text-warning mb-3 transition-scale"></i>
                                    <h5 class="card-title">Riwayat Pembelian</h5>
                                    <h3>{{ $historyCount }}</h3>
                                    <p class="text-muted small">Jumlah pembelian Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    ---

                    <div class="mt-5">
                        <h5 class="mb-3">🎯 Rekomendasi Event</h5>
                        @if($recommendedEvents->isNotEmpty())
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach($recommendedEvents as $event)
                                    <div class="col">
                                        <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">{{ $event->title }}</h5>
                                                <p class="card-text text-muted mb-2">
                                                    <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                                                </p>
                                                @if($event->location)
                                                    <p class="card-text text-muted mb-2">
                                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                                                    </p>
                                                @endif
                                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary mt-3">Lihat Detail <i class="fas fa-arrow-right ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info mt-2">Tidak ada rekomendasi event saat ini.</div>
                        @endif
                    </div>

                    ---

                    <div class="mt-5">
                        <h5 class="mb-3">📅 Kalender Event</h5>
                        <div id="calendar" style="max-width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 500,
            events: [
                @foreach($recommendedEvents as $event)
                {
                    title: '{{ $event->title }}',
                    start: '{{ $event->date }}',
                    url: '{{ route('events.show', $event->id) }}'
                },
                @endforeach
            ],
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
            }
        });

        calendar.render();
    });
</script>

<style>
    .hover-shadow:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .transition {
        transition: all 0.3s ease-in-out;
    }

    .transition-scale:hover {
        transform: scale(1.2);
    }
</style>
@endsection