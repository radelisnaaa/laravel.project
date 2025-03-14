<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-primary">Admin Dashboard</h1>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row mt-4">
            <!-- Event Management -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Event</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($events ?? []) }} Events</h5>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-light">Kelola Event</a>
                    </div>
                </div>
            </div>

            <!-- Order Management -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Orders</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($orders ?? []) }} Orders</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-light">Kelola Orders</a>
                    </div>
                </div>
            </div>

            <!-- User Management -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($users ?? []) }} Users</h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Kelola Users</a>
                    </div>
                </div>
            </div>

            <!-- Ticket Management -->
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Tickets</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($tickets ?? []) }} Tickets</h5>
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-light">Kelola Tickets</a>
                    </div>
                </div>
            </div>

            <!-- Payment Management -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Payments</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ count($payments ?? []) }} Payments</h5>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-light">Kelola Payments</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>
