<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Edit Event User</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Event User -->
    <form action="{{ route('eventusers.update', $eventUser->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilihan Event -->
        <div class="mb-3">
            <label for="event_id" class="form-label">Pilih Event</label>
            <select name="event_id" id="event_id" class="form-control @error('event_id') is-invalid @enderror" required>
                <option value="" disabled>-- Pilih Event --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id', $eventUser->event_id) == $event->id ? 'selected' : '' }}>
                        {{ $event->name }}
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilihan User -->
        <div class="mb-3">
            <label for="user_id" class="form-label">Pilih User</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="" disabled>-- Pilih User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $eventUser->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('eventusers.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
