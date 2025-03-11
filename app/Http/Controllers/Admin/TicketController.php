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
     * Pastikan hanya admin yang bisa mengakses controller ini.
     */
    // protected $middleware = [
    //     'auth',
    //     'admin'
    // ];

    public function index(): View
    {
        $tickets = Ticket::with('event')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        $events = Event::all();
        return view('admin.tickets.create', compact('events'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);

        Ticket::create($request->all());

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil ditambahkan');
    }

    public function edit(Ticket $ticket): View
    {
        $events = Event::all();
        return view('admin.tickets.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
        ]);

        $ticket->update($request->all());

        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil diperbarui');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Tiket berhasil dihapus');
    }
}
