<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd; /* Light blue background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff; /* White container for contrast */
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 700px;
            width: 100%;
        }
        .header-title {
            color: #2196f3; /* Bright blue header */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2em;
        }
        .info-section {
            margin-bottom: 25px;
            padding: 20px;
            background-color: #f0f8ff; /* Alice Blue for info sections */
            border-radius: 10px;
            border-left: 5px solid #2196f3; /* Blue accent line */
        }
        .info-section h4 {
            color: #1976d2; /* Slightly darker blue for section titles */
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #555;
        }
        .info-item i {
            margin-right: 15px;
            color: #2196f3; /* Blue icons */
            font-size: 1.2em;
            width: 20px; /* Ensure consistent icon width */
            text-align: center;
        }
        .stock-info {
            font-weight: bold;
        }
        .stock-available {
            color: #28a745;
        }
        .stock-unavailable {
            color: #f44336;
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            justify-content: flex-start;
        }
        .btn-primary, .btn-warning, .btn-danger, .btn-secondary, .btn-success {
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
        .btn-primary { background-color: #2196f3; }
        .btn-primary:hover { background-color: #1976d2; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-warning:hover { background-color: #e0b300; }
        .btn-danger { background-color: #f44336; }
        .btn-danger:hover { background-color: #d32f2f; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; }
        .btn-success { background-color: #28a745; }
        .btn-success:hover { background-color: #1e7e34; }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #1976d2;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #2196f3;
            text-decoration: underline;
        }
        .order-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #e0f7fa; /* Light cyan for order form */
            border-radius: 10px;
        }
        .order-form label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        .order-form input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        .order-form button {
            width: 100%;
        }
        .stock-message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
        }
        .stock-message.available {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .stock-message.unavailable {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="header-title"><i class="fas fa-ticket-alt me-2"></i> Detail Tiket</h1>

        <div class="info-section">
            <h4><i class="fas fa-info-circle me-2"></i> Informasi Tiket</h4>
            <div class="info-item">
                <i class="fas fa-calendar-alt"></i>
                <strong>Event:</strong> {{ $ticket->event->name }}
            </div>
            <div class="info-item">
                <i class="fas fa-tag"></i>
                <strong>Jenis Tiket:</strong> {{ $ticket->ticket_type }}
            </div>
            <div class="info-item">
                <i class="fas fa-coins"></i>
                <strong>Harga:</strong> Rp{{ number_format($ticket->price, 0, ',', '.') }}
            </div>
            <div class="info-item">
                <i class="fas fa-sort-numeric-up"></i>
                <strong>Kuota:</strong> {{ $ticket->quota }}
            </div>
            <div class="info-item">
                <i class="fas fa-cubes"></i>
                <strong>Stok Tersisa:</strong>
                @php
                    $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
                @endphp
                <span class="stock-info {{ $stokTersisa > 0 ? 'stock-available' : 'stock-unavailable' }}">
                    {{ $stokTersisa > 0 ? $stokTersisa . ' tersedia' : 'Stok habis' }}
                </span>
            </div>
        </div>

        @if(Auth::check() && Auth::user()->is_admin)
            <div class="action-buttons">
                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt me-2"></i> Edit Tiket</a>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt me-2"></i> Hapus Tiket</button>
                </form>
            </div>
        @else
            @if($stokTersisa > 0)
                <div class="order-form">
                    <h4><i class="fas fa-shopping-cart me-2"></i> Pesan Tiket</h4>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <label for="quantity"><i class="fas fa-ticket me-2"></i> Jumlah Tiket:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $stokTersisa }}" required>
                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-check me-2"></i> Konfirmasi Pesanan</button>
                    </form>
                </div>
            @else
                <div class="stock-message unavailable">
                    <i class="fas fa-exclamation-triangle me-2"></i> Tiket sudah habis, tidak bisa dipesan.
                </div>
            @endif
        @endif

        <a href="{{ route('admin.tickets.index') }}" class="back-link"><i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Tiket</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>