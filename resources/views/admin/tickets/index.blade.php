<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Event</th>
    <th>Jenis Tiket</th>
    <th>Harga</th>
    <th>Kuota</th>
    <th>Stok Tersisa</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
@forelse ($tickets as $ticket)
    @php
        $stokTersisa = $ticket->quota - $ticket->orders->sum('quantity');
    @endphp
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->event->name }}</td>
        <td>{{ $ticket->ticket_type }}</td>
        <td>{{ number_format($ticket->price, 2) }}</td>
        <td>{{ $ticket->quota }}</td>
        <td>{{ $stokTersisa > 0 ? $stokTersisa . ' tersedia' : 'Stok habis' }}</td>
        <td>
            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-info-circle"></i> Detail
            </a>
            @if (Auth::check() && (Auth::id() === $ticket->user_id || Auth::user()->is_admin))
                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">Tidak ada tiket.</td>
    </tr>
@endforelse
