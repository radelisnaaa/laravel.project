@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <h1 class="admin-title"><i class="fas fa-plus-circle me-2"></i> Tambah Acara Baru</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            @if ($errors->any())
                <div class="alert alert-danger-admin">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <div class="form-group">
                        <input type="text" class="form-control-admin @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Acara" value="{{ old('name') }}" required>
                        <label for="name" class="form-label-admin"><i class="fas fa-signature me-1"></i> Nama Acara</label>
                        @error('name')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea class="form-control-admin @error('description') is-invalid @enderror" id="description" name="description" placeholder="Deskripsi Acara" rows="3" required>{{ old('description') }}</textarea>
                        <label for="description" class="form-label-admin"><i class="fas fa-file-alt me-1"></i> Deskripsi Acara</label>
                        @error('description')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control-admin @error('speaker') is-invalid @enderror" id="speaker" name="speaker" placeholder="Pembicara" value="{{ old('speaker') }}" required>
                        <label for="speaker" class="form-label-admin"><i class="fas fa-microphone me-1"></i> Pembicara</label>
                        @error('speaker')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="url" class="form-control-admin @error('zoom_link') is-invalid @enderror" id="zoom_link" name="zoom_link" placeholder="Link Zoom (opsional)" value="{{ old('zoom_link') }}">
                        <label for="zoom_link" class="form-label-admin"><i class="fas fa-link me-1"></i> Link Zoom</label>
                        @error('zoom_link')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control-admin @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') ? old('date') : now()->format('Y-m-d') }}" placeholder="Tanggal Acara" required>
                        <label for="date" class="form-label-admin"><i class="fas fa-calendar-alt me-1"></i> Tanggal Acara</label>
                        @error('date')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="file" class="form-control-admin @error('image') is-invalid @enderror" id="image" name="image" placeholder="Gambar Acara" required>
                        <label for="image" class="form-label-admin"><i class="fas fa-image me-1"></i> Gambar Acara</label>
                        @error('image')
                            <div class="invalid-feedback-admin">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-admin"><i class="fas fa-save me-1"></i> SIMPAN</button>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary-admin"><i class="fas fa-arrow-left me-1"></i> KEMBALI</a>
                    </div>
                </form>
            </div>
        @else
            <p class="no-access-admin"><i class="fas fa-ban me-2"></i> Anda tidak memiliki akses ke halaman ini.</p>
        @endif
    </div>

    <script>
        const formControls = document.querySelectorAll('.form-control-admin');

        formControls.forEach(control => {
            const label = control.nextElementSibling;
            if (label && label.classList.contains('form-label-admin')) {
                if (control.value) {
                    label.classList.add('active');
                }

                control.addEventListener('focus', () => {
                    label.classList.add('active');
                });

                control.addEventListener('blur', () => {
                    if (!control.value) {
                        label.classList.remove('active');
                    }
                });
            }
        });
    </script>
@endsection

<style>
    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 800px;
        width: 100%;
        margin-top: 20px; /* Optional: Adjust top margin as needed */
        margin-bottom: 20px; /* Optional: Adjust bottom margin as needed */
    }

    .admin-title {
        color: #1e88e5;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
        font-size: 2.5em;
    }

    .form-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .form-group {
        position: relative;
        margin-bottom: 25px;
    }

    .form-label-admin {
        position: absolute;
        top: 8px;
        left: 10px;
        font-size: 0.9em;
        color: #777;
        font-weight: normal;
        pointer-events: none;
        transition: all 0.2s ease-in-out;
        background-color: white;
        padding: 0 5px;
    }

    .form-control-admin {
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 12px;
        display: block;
        width: 100%;
        font-size: 1em;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control-admin:focus {
        border-color: #1e88e5;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
    }

    .form-control-admin::placeholder {
        color: transparent;
    }

    .form-control-admin:not(:placeholder-shown) + .form-label-admin,
    .form-control-admin:focus + .form-label-admin {
        transform: translateY(-10px) translateX(-5px) scale(0.8);
        color: #1e88e5;
    }

    .invalid-feedback-admin {
        color: #dc3545;
        font-size: 0.8em;
        margin-top: 5px;
    }

    .btn-primary-admin {
        background-color: #1e88e5;
        border-color: #1e88e5;
        color: white;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 1em;
        transition: background-color 0.15s ease-in-out;
    }

    .btn-primary-admin:hover {
        background-color: #1565c0;
        border-color: #1565c0;
    }

    .btn-secondary-admin {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 1em;
        transition: background-color 0.15s ease-in-out;
    }

    .btn-secondary-admin:hover {
        background-color: #545b62;
        border-color: #4e555b;
    }

    .alert-danger-admin {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        border-radius: 4px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .no-access-admin {
        text-align: center;
        margin-top: 20px;
        color: #dc3545;
        font-style: italic;
    }
</style>