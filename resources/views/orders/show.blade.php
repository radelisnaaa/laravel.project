<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Soft light blue background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            margin: 0;
            padding: 30px;
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

        .page-title {
            color: #1e88e5; /* Vibrant blue title */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2em;
        }

        .order-details {
            margin-bottom: 20px;
            padding: 25px;
            border-radius: 10px;
            background-color: #f9fbe7; /* Light yellow-green for details */
            border-left: 5px solid #1e88e5; /* Blue accent border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .order-details p {
            margin-bottom: 12px;
            font-size: 1.1em;
            display: flex; /* Use flexbox for label and value alignment */
            justify-content: space-between;
            align-items: center;
        }

        .order-details strong {
            color: #333;
            margin-right: 10px; /* Add some space between label and value */
        }

        .back-button {
            background-color: #1e88e5; /* Vibrant blue button */
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background-color: #1565c0; /* Darker blue on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="page-title"><i class="fas fa-file-invoice-dollar me-2"></i> Detail Order #{{ $order->id }}</h1>

        <div class="order-details">
            <p>
                <strong><i class="fas fa-calendar-alt me-1"></i> Event:</strong>
                <span>{{ $order->ticket->event->name }}</span>
            </p>
            <p>
                <strong><i class="fas fa-ticket-alt me-1"></i> Tiket:</strong>
                <span>{{ $order->ticket->name }} (ID: {{ $order->ticket->id }})</span>
            </p>
            <p>
                <strong><i class="fas fa-shopping-cart me-1"></i> Jumlah:</strong>
                <span>{{ $order->quantity }}</span>
            </p>
            <p>
                <strong><i class="fas fa-coins me-1"></i> Total Harga:</strong>
                <span>Rp{{ number_format($order->total_price) }}</span>
            </p>
            <p>
                <strong><i class="fas fa-calendar-check me-1"></i> Tanggal Pembelian:</strong>
                <span>{{ $order->created_at->format('d F Y') }}</span>
            </p>
        </div>

        <a href="{{ route('orders.index') }}" class="back-button">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Order
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>