<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function buyTicket(Request $request, $eventId)
    {
        $event = Event::with('tickets')->findOrFail($eventId);
        $ticket = $event->tickets->first(); // Ambil tiket terkait

        if (!$ticket || $ticket->quota < $request->jumlah) {
return back()->with('error', 'Stok tiket tidak cukup.');
        }            

        // Proses pengurangan stok
        $ticket->quota -= $request->jumlah;
        $ticket->save();

        return back()->with('success', 'Tiket berhasil dibeli!');
    }

    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string',
            'price' => 'required|numeric',
            'quota' => 'required|integer'
        ]);

        $ticket = Ticket::create([
            'event_id' => $request->event_id,
            'ticket_type' => $request->ticket_type,
            'price' => $request->price,
            'quota' => $request->quota,
           
        ]);

 

        return redirect()->route('tickets.index')->with('success', 'Ticket successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|string',
            'price' => 'required|numeric',
            'quota' => 'required|integer'
        ]);
        $ticket->update($validated);
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully');
    }
        //
    }


