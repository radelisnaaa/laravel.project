<!-- resources/views/users/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna</title>
</head>
<body>
    <h1>Detail Pengguna</h1>

    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <p><strong>Telepon:</strong> {{ $user->phone }}</p>
    <p><strong>Organisasi:</strong> {{ $user->organization }}</p>
    <p><strong>Avatar:</strong> <img src="{{ $user->avatar }}" alt="Avatar" width="100"></p>

    <a href="{{ route('users.index') }}">Kembali ke Daftar Pengguna</a>
</body>
</html>
