<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
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
            max-width: 950px;
            width: 100%;
        }

        .page-title {
            color: #1e88e5; /* Vibrant blue title */
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2em;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #e1f5fe; /* Light blue for success */
            border-color: #b3e5fc;
            color: #1e88e5;
        }

        .alert-danger {
            background-color: #ffebee; /* Light red for error */
            border-color: #ef9a9a;
            color: #e53935;
        }

        .card-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .table {
            background-color: #fff;
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #1e88e5; /* Vibrant blue header */
            color: white;
            border-bottom: 2px solid #1565c0;
            font-weight: bold;
            padding: 12px;
            text-align: center;
        }

        .table tbody td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table img {
            border-radius: 8px;
            max-width: 40px;
            height: auto;
            vertical-align: middle;
            margin-right: 5px;
        }

        .badge {
            font-size: 0.85rem;
            border-radius: 5px;
            padding: 0.4em 0.6em;
            font-weight: normal;
        }

        .btn-info,
        .btn-warning,
        .btn-danger {
            border-radius: 8px;
            font-size: 0.9em;
            padding: 8px 12px;
            margin: 0 5px;
        }

        .btn-info {
            background-color: #64b5f6;
            border-color: #64b5f6;
        }

        .btn-info:hover {
            background-color: #42a5f5;
            border-color: #42a5f5;
        }

        .btn-warning {
            background-color: #ffb74d;
            border-color: #ffb74d;
        }

        .btn-warning:hover {
            background-color: #ffa726;
            border-color: #ffa726;
        }

        .btn-danger {
            background-color: #e57373;
            border-color: #e57373;
        }

        .btn-danger:hover {
            background-color: #f44336;
            border-color: #f44336;
        }

        .add-button-container {
            margin-top: 20px;
            text-align: right;
        }

        .btn-primary {
            background-color: #1e88e5;
            border-color: #1e88e5;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }

        .no-users {
            text-align: center;
            color: #777;
            font-style: italic;
            margin-top: 20px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #1e88e5;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="page-title"><i class="fas fa-users me-2"></i> Daftar Pengguna</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-shadow">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-success"><i class="fas fa-user-shield me-1"></i>Admin</span>
                                    @elseif ($user->role === 'participant')
                                        <span class="badge bg-warning text-dark"><i class="fas fa-user me-1"></i>Participant</span>
                                    @elseif ($user->role === 'organization')
                                        <span class="badge bg-info text-white"><i class="fas fa-building me-1"></i>Organization</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-user-tag me-1"></i>{{ ucfirst($user->role) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye me-1"></i>Detail</a>

                                    @if (Auth::check() && Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt me-1"></i>Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center no-users">Tidak ada pengguna terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="add-button-container">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i>Tambah Pengguna Baru</a>
            </div>
        @endif

        @if (!Auth::check())
            <p class="login-link">Silakan <a href="{{ route('login') }}">login</a> untuk melihat daftar pengguna.</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>