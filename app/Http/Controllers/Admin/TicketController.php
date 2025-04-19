<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Menampilkan daftar tiket (khusus admin).
     */
    public function index(): View
    {
        $tickets = Ticket::with('event')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Menampilkan form untuk membuat tiket baru (khusus admin).
     */
    public function create(): View
    {
        // Ambil semua event untuk dipilih ketika membuat tiket baru
        $events = Event::all();
        return view('admin.tickets.create', compact('events'));
    }

    /**
     * Menyimpan tiket yang baru dibuat (khusus admin).
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input form
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);

        // Simpan data tiket ke database
        Ticket::create($request->all());

        // Redirect ke halaman tiket dengan pesan sukses
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil ditambahkan');
    }

    /**
     * Menampilkan detail tiket tertentu (khusus admin).
     */
    public function show($id): View
    {
        // Ambil tiket berdasarkan ID yang diberikan
        $ticket = Ticket::with('event')->findOrFail($id);

        // Tampilkan ke view 'admin.tickets.show'
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Menampilkan form untuk mengedit tiket (khusus admin).
     */
    public function edit(Ticket $ticket): View
    {
        // Ambil semua event untuk dipilih ketika mengedit tiket
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'events'));
    }

    /**
     * Mengupdate tiket yang sudah ada (khusus admin).
     */
    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        // Validasi input form
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);

        // Update data tiket
        $ticket->update($request->all());

        // Redirect ke halaman tiket dengan pesan sukses
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui');
    }

    /**
     * Menghapus tiket (khusus admin).
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        // Hapus tiket dari database
        $ticket->delete();

        // Redirect ke halaman tiket dengan pesan sukses
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus');
    }
}
