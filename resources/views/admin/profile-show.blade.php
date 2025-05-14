@include('layouts.admin-app')

<div class="container mt-5">
    <h2>Detail Profil Admin</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
</div>
