<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 650px;
            width: 100%;
        }

        .admin-title {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2.2em;
        }

        .card-admin {
            background-color: #f5f5f5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            border-left: 5px solid #1e88e5;
        }

        .card-body-admin {
            padding: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-label-admin {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 1em;
            color: #777;
            font-weight: normal;
            pointer-events: none;
            transition: all 0.2s ease-in-out;
            background-color: #f5f5f5;
            padding-right: 5px;
            padding-left: 5px;
        }

        .form-control-admin {
            border-radius: 6px;
            border-color: #ced4da;
            padding: 15px 10px 5px;
            display: block;
            width: 100%;
            font-size: 1em;
            background: transparent;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .form-control-admin::placeholder {
            color: transparent;
        }

        .form-control-admin:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
        }

        .form-control-admin:focus + .form-label-admin,
        .form-control-admin:not(:placeholder-shown) + .form-label-admin {
            transform: translateY(-20px) translateX(-5px) scale(0.8);
            color: #1e88e5;
            background-color: #f5f5f5;
            padding-right: 5px;
            padding-left: 5px;
        }

        .form-label-admin.active {
            transform: translateY(-20px) translateX(-5px) scale(0.8);
            color: #1e88e5;
            background-color: #f5f5f5;
            padding-right: 5px;
            padding-left: 5px;
        }

        .invalid-feedback-admin {
            color: #d32f2f;
            position: absolute;
            top: 100%;
            left: 0;
            font-size: 0.8em;
        }

        .btn-admin-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
            border-radius: 6px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-admin-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-admin-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 6px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-admin-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .alert-danger-admin {
            background-color: #ffebee;
            border-color: #ef9a9a;
            color: #d32f2f;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .no-access-admin {
            text-align: center;
            margin-top: 20px;
            color: #d32f2f;
            font-style: italic;
        }
    </style>
</head>
<body>
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

            <div class="card-admin">
                <div class="card-body-admin">
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
                            <button type="submit" class="btn btn-admin-primary"><i class="fas fa-save me-1"></i> SIMPAN</button>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-admin-secondary"><i class="fas fa-arrow-left me-1"></i> KEMBALI</a>
                        </div>
                    </form>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-control-admin {
        border-radius: 6px;
        border-color: #ced4da;
        padding: 15px 10px 5px;
        display: block;
        width: 100%;
        font-size: 1em;
        background: transparent;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .form-control-admin::placeholder {
        color: transparent;
    }

    .form-label-admin {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 1em;
        color: #777;
        font-weight: normal;
        pointer-events: none;
        transition: all 0.2s ease-in-out;
    }

    .form-control-admin:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
    }

    .form-control-admin:focus + .form-label-admin,
    .form-control-admin:not(:placeholder-shown) + .form-label-admin {
        transform: translateY(-20px) translateX(-5px) scale(0.8);
        color: #1e88e5;
        background-color: #f5f5f5;
        padding-right: 5px;
        padding-left: 5px;
    }

    .form-label-admin.active {
        transform: translateY(-20px) translateX(-5px) scale(0.8);
        color: #1e88e5;
        background-color: #f5f5f5;
        padding-right: 5px;
        padding-left: 5px;
    }
</style>