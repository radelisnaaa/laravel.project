<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $fillable = [
        'event_id', 
        'ticket_type', 
        'price', 
        'quota'
    ];
    
    public function event() 
    {
        return $this->belongsTo(Event::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
