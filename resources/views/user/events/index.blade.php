@extends('layouts.admin-app')

@section('title', 'Event Saya')
@section('title-content', 'Event Saya')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4"><i class="fas fa-calendar-check me-2"></i> Event Saya</h1>

        @if ($myEvents->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-1"></i> Anda belum mengikuti event apapun.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($myEvents as $event)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $event->title }}</h5>
                                <p class="card-text mb-1">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                                </p>
                                @if ($event->speaker)
                                    <p class="card-text mb-1">
                                        <i class="fas fa-user-tie me-1"></i> {{ $event->speaker }}
                                    </p>
                                @endif
                                <p class="card-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    {{ Str::limit($event->description, 80) }}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 text-end">
                                <a href="{{ route('user.events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $myEvents->links() }}
            </div>
        @endif
    </div>
@endsection