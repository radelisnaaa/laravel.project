@extends('layouts.admin-app')

@section('title', 'Dashboard')
@section('title-content', 'Dasbor Admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row mt-4">
        {{-- Event --}}
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-calendar-alt fa-2x text-primary transition-scale"></i>
                    </div>
                    <h5 class="card-title">{{ count($events ?? []) }} Event</h5>
                    <p class="text-muted small">Jumlah total event yang tersedia.</p>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">Kelola Event</a>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-shopping-cart fa-2x text-success transition-scale"></i>
                    </div>
                    <h5 class="card-title">{{ count($orders ?? []) }} Pesanan</h5>
                    <p class="text-muted small">Total pesanan tiket yang masuk.</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success">Kelola Pesanan</a>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-users fa-2x text-info transition-scale"></i>
                    </div>
                    <h5 class="card-title">{{ count($users ?? []) }} Pengguna</h5>
                    <p class="text-muted small">Pengguna yang terdaftar di platform.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-info">Kelola Pengguna</a>
                </div>
            </div>
        </div>

        {{-- Tickets --}}
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card border-0 shadow-sm h-100 hover-shadow transition">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-ticket-alt fa-2x text-warning transition-scale"></i>
                    </div>
                    <h5 class="card-title">{{ count($tickets ?? []) }} Tiket</h5>
                    <p class="text-muted small">Total tiket yang tersedia/terjual.</p>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-outline-warning">Kelola Tiket</a>
                </div>
            </div>
        </div>
    </div>
@endsection
