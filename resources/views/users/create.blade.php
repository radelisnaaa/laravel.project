<!-- resources/views/users/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
</head>
<body>
    <h1>Tambah Pengguna Baru</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="participant">Participant</option>
            <option value="organizer">Organizer</option>
        </select><br>

        <label for="phone">Telepon:</label>
        <input type="text" name="phone" id="phone"><br>

        <label for="organization">Organisasi:</label>
        <input type="text" name="organization" id="organization"><br>

        <!-- <label for="avatar">Avatar URL:</label>
        <input type="text" name="avatar" id="avatar"><br> -->

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('users.index') }}">Kembali ke Daftar Pengguna</a>
</body>
</html>
