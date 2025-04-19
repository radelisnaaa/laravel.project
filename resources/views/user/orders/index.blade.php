<table class="table">
    <thead>
        <tr>
            <th>ID Order</th>
            <th>Event</th>
            <th>Jenis Tiket</th>
            <th>Status</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->ticket->event->name }}</td>
                <td>{{ $order->ticket->ticket_type }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ number_format($order->total_price, 2) }}</td>
                <td>
                    <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination">
    {{ $orders->links() }}
</div>
