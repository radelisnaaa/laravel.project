<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 
        'ticket_type', 
        'price', 
        'quota' // ini bisa kamu anggap sebagai stok
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Menghubungkan ke banyak order (satu tiket bisa dibeli oleh banyak user)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Opsional: total yang sudah dipesan
    public function totalOrdered()
    {
        return $this->orders()->sum('quantity');
    }

    // Opsional: stok tersisa
    public function getRemainingStockAttribute()
    {
        return $this->quota - $this->totalOrdered();
    }
}
