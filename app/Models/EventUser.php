<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventUser extends Pivot
{
    protected $table = 'event_users';

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public $timestamps = false; // Jika tabel tidak memiliki created_at & updated_at

    // Relasi dengan Event
    public function event()
    {
        return $this->belongsToMany(Event::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
