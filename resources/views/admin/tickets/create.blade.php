<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tiket Baru</title>
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
            background-color: #f5f5f5; /* Light gray container */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 40px;
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
        .form-section {
            margin-bottom: 25px;
            padding: 20px;
            background-color: #e1f5fe; /* Very light blue form background */
            border-radius: 10px;
            border-left: 5px solid #1e88e5; /* Blue accent line */
        }
        .form-section h4 {
            color: #1565c0; /* Darker blue for section title */
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
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
        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: flex-end; /* Align buttons to the right */
        }
        .btn-primary, .btn-secondary {
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
        }
        .btn-primary { background-color: #1e88e5; }
        .btn-primary:hover { background-color: #1565c0; }
        .btn-secondary { background-color: #78909c; }
        .btn-secondary:hover { background-color: #546e7a; }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
            text-align: center; /* Center the back link */
        }
        .back-link:hover {
            color: #1e88e5;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="header-title"><i class="fas fa-plus-circle me-2"></i> Tambah Tiket Baru</h1>

        <div class="form-section">
            <h4><i class="fas fa-info-circle me-2"></i> Detail Tiket</h4>
            <form action="{{ route('admin.tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="event_id" class="fw-bold"><i class="fas fa-calendar-alt me-2"></i> ID Event</label>
                    <input type="number" name="event_id" id="event_id" class="form-control @error('event_id') is-invalid @enderror" value="{{ old('event_id') }}" required>
                    @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ticket_type" class="fw-bold"><i class="fas fa-tag me-2"></i> Jenis Tiket</label>
                    <input type="text" name="ticket_type" id="ticket_type" class="form-control @error('ticket_type') is-invalid @enderror" value="{{ old('ticket_type') }}" required>
                    @error('ticket_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="fw-bold"><i class="fas fa-coins me-2"></i> Harga</label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quota" class="fw-bold"><i class="fas fa-sort-numeric-up me-2"></i> Kuota</label>
                    <input type="number" name="quota" id="quota" class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota') }}" required>
                    @error('quota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan</button>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary"><i class="fas fa-ban me-2"></i> Kembali</a>
                </div>
            </form>
        </div>

        <a href="{{ route('admin.tickets.index') }}" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Tiket</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>