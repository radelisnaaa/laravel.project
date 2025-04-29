<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Profil Saya</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Tanggal Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-warning">Edit Profil</a>
            </div>
        </div>
    </div>
</body>
</html>
