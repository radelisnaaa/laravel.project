<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Soft light blue background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff; /* White container */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            width: 100%;
        }
        .header-title {
            color: #1e88e5; /* Vibrant blue header */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2em;
        }
        .card-form {
            background-color: #f5f5f5; /* Light gray card */
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .form-label {
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1em;
        }
        .form-control.is-invalid {
            border-color: #e53935;
        }
        .invalid-feedback {
            color: #e53935;
            margin-top: 5px;
            font-size: 0.9em;
        }
        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        .btn-secondary {
            background-color: #78909c;
            border-color: #78909c;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1em;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #546e7a;
            border-color: #546e7a;
        }
        .d-grid {
            gap: 15px;
        }
        .mt-2 {
            margin-top: 10px;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
            display: block;
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #1e88e5;
            text-decoration: underline;
        }
        .text-danger {
            color: #e53935 !important;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="header-title"><i class="fas fa-pencil-alt me-2"></i> Edit Acara</h1>

        @if (Auth::check() && Auth::user()->role === 'admin')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i> Ada kesalahan dalam pengisian formulir:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card-form shadow-lg">
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold"><i class="fas fa-signature me-2"></i> Nama Acara</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" placeholder="Masukkan Nama Acara" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="speaker" class="form-label fw-bold"><i class="fas fa-microphone me-2"></i> Pembicara</label>
                            <input type="text" class="form-control @error('speaker') is-invalid @enderror" id="speaker" name="speaker" value="{{ old('speaker', $event->speaker) }}" placeholder="Masukkan Pembicara" required>
                            @error('speaker')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold"><i class="fas fa-file-alt me-2"></i> Deskripsi Acara</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Masukkan Deskripsi Acara" rows="3" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold"><i class="fas fa-calendar-alt me-2"></i> Tanggal Acara</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $event->date) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold"><i class="fas fa-image me-2"></i> Gambar Acara</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" width="100" class="mt-2 rounded">
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN</button>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i> KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Anda tidak memiliki akses ke halaman ini.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>