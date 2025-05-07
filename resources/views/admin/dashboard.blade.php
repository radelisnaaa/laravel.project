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
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-alt me-2 text-primary"></i> {{ count($events ?? []) }} Event</h5>
                    <p class="card-text text-muted">Jumlah total event yang tersedia.</p>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">Kelola Event</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart me-2 text-success"></i> {{ count($orders ?? []) }} Pesanan</h5>
                    <p class="card-text text-muted">Total pesanan tiket yang masuk.</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-success">Kelola Pesanan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users me-2 text-info"></i> {{ count($users ?? []) }} Pengguna</h5>
                    <p class="card-text text-muted">Pengguna yang terdaftar di platform.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-info">Kelola Pengguna</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-ticket-alt me-2 text-warning"></i> {{ count($tickets ?? []) }} Tiket</h5>
                    <p class="card-text text-muted">Total tiket yang tersedia/terjual.</p>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-outline-warning">Kelola Tiket</a>
                </div>
            </div>
        </div>
    </div>

    
@endsection
