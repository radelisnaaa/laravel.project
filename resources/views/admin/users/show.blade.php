<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1); /* More pronounced shadow */
            padding: 40px; /* More padding */
            max-width: 650px; /* Slightly wider */
            width: 100%;
        }

        .page-title {
            color: #1e88e5; /* Vibrant blue title */
            text-align: center;
            margin-bottom: 40px; /* More margin */
            font-weight: bold;
            font-size: 2.2em; /* Slightly larger */
        }

        .detail-card {
            background-color: #f9fbe7; /* Light yellow-green background for detail card */
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            border-left: 5px solid #1e88e5; /* Blue accent */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .detail-icon {
            color: #1e88e5; /* Blue icon */
            margin-right: 15px;
            font-size: 1.2em;
            width: 25px; /* Fixed width for alignment */
            text-align: center;
        }

        .detail-label {
            font-weight: bold;
            color: #333;
            width: 100px; /* Fixed width for label alignment */
        }

        .detail-value {
            font-size: 1.1em;
            color: #555;
        }

        .badge {
            font-size: 0.9em;
            border-radius: 8px;
            padding: 0.5em 0.8em;
            font-weight: normal;
        }

        .btn-primary {
            background-color: #1e88e5; /* Vibrant blue button */
            border-color: #1e88e5;
            border-radius: 8px;
            padding: 12px 20px; /* More padding */
            font-size: 1.1em; /* Slightly larger */
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #1565c0; /* Darker blue on hover */
            border-color: #1565c0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .not-found {
            text-align: center;
            color: #e53935; /* Red color for not found */
            font-size: 1.3em; /* Slightly larger */
            font-style: italic;
            padding: 20px;
            background-color: #ffebee; /* Light red background */
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title"><i class="fas fa-user-circle me-2"></i> Detail Pengguna</h1>

        @if ($user)
            <div class="detail-card">
                <div class="detail-row">
                    <i class="fas fa-id-card detail-icon"></i>
                    <span class="detail-label">ID:</span>
                    <span class="detail-value">{{ $user->id }}</span>
                </div>
                <div class="detail-row">
                    <i class="fas fa-user detail-icon"></i>
                    <span class="detail-label">Nama:</span>
                    <span class="detail-value">{{ $user->name }}</span>
                </div>
                <div class="detail-row">
                    <i class="fas fa-envelope detail-icon"></i>
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $user->email }}</span>
                </div>
                <div class="detail-row">
                    <i class="fas fa-user-tag detail-icon"></i>
                    <span class="detail-label">Role:</span>
                    <span class="detail-value">
                        @if ($user->role === 'admin')
                            <span class="badge bg-success"><i class="fas fa-user-shield me-1"></i>Admin</span>
                        @elseif ($user->role === 'participant')
                            <span class="badge bg-warning text-dark"><i class="fas fa-user me-1"></i>Participant</span>
                        @elseif ($user->role === 'organization')
                            <span class="badge bg-info text-white"><i class="fas fa-building me-1"></i>Organization</span>
                        @else
                            <span class="badge bg-secondary"><i class="fas fa-user-tag me-1"></i>{{ ucfirst($user->role) }}</span>
                        @endif
                    </span>
                </div>
                @if ($user->phone)
                    <div class="detail-row">
                        <i class="fas fa-phone detail-icon"></i>
                        <span class="detail-label">Telepon:</span>
                        <span class="detail-value">{{ $user->phone }}</span>
                    </div>
                @endif
                @if ($user->organization)
                    <div class="detail-row">
                        <i class="fas fa-building detail-icon"></i>
                        <span class="detail-label">Organisasi:</span>
                        <span class="detail-value">{{ $user->organization }}</span>
                    </div>
                @endif
                {{-- @if ($user->avatar)
                    <div class="detail-row">
                        <i class="fas fa-image detail-icon"></i>
                        <span class="detail-label">Avatar:</span>
                        <span class="detail-value"><img src="{{ $user->avatar }}" alt="Avatar" width="100" style="border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></span>
                    </div>
                @endif --}}
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pengguna</a>
        @else
            <p class="not-found"><i class="fas fa-exclamation-triangle me-2"></i> Pengguna tidak ditemukan</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>