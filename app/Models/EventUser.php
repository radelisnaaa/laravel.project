<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventUser extends Pivot
{
    protected $table = 'event_user'; // Sesuaikan dengan nama tabel yang ada di database

    protected $fillable = [
        'event_id',
        'user_id',
        'order_id'
    ];

    public $timestamps = false; // Jika tabel tidak memiliki created_at & updated_at

    // Relasi dengan Event (Pivot hanya memiliki belongsTo, bukan belongsToMany)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
