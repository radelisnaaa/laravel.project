@extends('layouts.user-app')

@section('title', 'Dashboard User')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Dashboard Stats -->
                            <div class="col-md-4 mb-4">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h5>Jumlah Event</h5>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $eventCount }}</h3>
                                        <p>Event yang Anda ikuti</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5>Pesanan Tiket</h5>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $orderCount }}</h3>
                                        <p>Total pesanan tiket Anda</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card text-center shadow-sm">
                                    <div class="card-header bg-warning text-white">
                                        <h5>Riwayat Pembelian</h5>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $historyCount }}</h3>
                                        <p>Jumlah pembelian Anda</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
                            <p>Ini adalah dashboard Anda, Anda dapat mengelola profil, melihat event yang diikuti, dan memeriksa riwayat pembelian tiket.</p>

                            <div class="mt-4">
                                <h5>Rekomendasi Event</h5>
                                @if($recommendedEvents->isNotEmpty())
                                    <ul class="list-group">
                                        @foreach($recommendedEvents as $event)
                                            <li class="list-group-item">
                                                <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none">
                                                    {{ $event->title }} - {{ $event->date }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Tidak ada rekomendasi event saat ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
