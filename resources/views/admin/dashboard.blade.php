<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Soft light blue background (sesuai kesepakatan) */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444; /* Darker text for better readability */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 960px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            color: #1e88e5; /* Vibrant blue title (sesuai kesepakatan) */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2.5em;
        }

        .alert-success {
            background-color: #e1f5fe; /* Light blue for success alert */
            border-color: #b3e5fc;
            color: #1e88e5;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #ffebee; /* Light red for error alert */
            border-color: #ef9a9a;
            color: #e53935;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            border-left: 5px solid #2196f3; /* Blue accent for cards */
        }

        .dashboard-card:hover {
            transform: scale(1.02);
        }

        .card-header {
            background-color: #bbdefb; /* Light blue header */
            color: #1976d2; /* Darker blue header text */
            padding: 15px;
            border-bottom: 1px solid #90caf9;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            color: #1e88e5; /* Vibrant blue title (sesuai kesepakatan) */
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn-dashboard {
            background-color: #1e88e5; /* Vibrant blue button (sesuai kesepakatan) */
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1em;
        }

        .btn-dashboard:hover {
            background-color: #1565c0; /* Darker blue on hover */
        }

        .logout-btn {
            background-color: #e53935; /* Red logout button (tetap merah untuk kontras) */
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 1em;
            display: block;
            margin-top: 30px;
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #c62828; /* Darker red on hover */
        }

        /* Grid Layout for Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="dashboard-title"><i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}</div>
        @endif

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header"><i class="fas fa-calendar-alt"></i> Event</div>
                <div class="card-body">
                    <h5 class="card-title">{{ count($events ?? []) }} Events</h5>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-dashboard"><i class="fas fa-folder-open me-2"></i> Kelola Event</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header"><i class="fas fa-shopping-cart"></i> Orders</div>
                <div class="card-body">
                    <h5 class="card-title">{{ count($orders ?? []) }} Orders</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-dashboard"><i class="fas fa-list-alt me-2"></i> Kelola Orders</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header"><i class="fas fa-users"></i> Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ count($users ?? []) }} Users</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-dashboard"><i class="fas fa-user-cog me-2"></i> Kelola Users</a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header"><i class="fas fa-ticket-alt"></i> Tickets</div>
                <div class="card-body">
                    <h5 class="card-title">{{ count($tickets ?? []) }} Tickets</h5>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-dashboard"><i class="fas fa-tags me-2"></i> Kelola Tickets</a>
                </div>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>