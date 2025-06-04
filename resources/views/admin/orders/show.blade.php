@extends('layouts.admin-app')

@section('title', 'Detail Order')

@section('title-content')
    Detail Order #{{ $order->id }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Order</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-nowrap">ID Order</th>
                                    <td>: {{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Event</th>
                                    <td>: {{ $order->ticket->event->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Tiket</th>
                                    <td>: {{ $order->ticket->name }} (ID: {{ $order->ticket->id }})</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Pembeli</th>
                                    <td>: {{ $order->user->name }} (ID: {{ $order->user->id }})</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Jumlah</th>
                                    <td>: {{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Total Harga</th>
                                    <td>: Rp{{ number_format($order->total_price * 1000, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-nowrap">Tanggal Pembelian</th>
                                    <td>: {{ $order->created_at->format('d F Y, H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-header .font-weight-bold {
            font-size: 1.2rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #e3e6f0;
        }
        .table th {
            font-weight: 500;
        }
        .btn-secondary {
            color: #fff;
            background-color: #858796;
            border-color: #858796;
        }
        .btn-secondary:hover {
            background-color: #6a6c75;
            border-color: #6a6c75;
        }
        .btn-secondary:focus {
            box-shadow: 0 0 0 0.2rem rgba(133, 135, 150, 0.5);
        }
    </style>
@endpush
