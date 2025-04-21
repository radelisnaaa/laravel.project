<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'speaker',
        'image',  
        'description',
        'zoom_link',
        'date',
        'price',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'datetime', // pastikan kolom 'date' jadi Carbon instance
        'price' => 'decimal:2',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('order_id')->withTimestamps();
    }

    // Tambahkan method isOngoing
    public function isOngoing(): bool
    {
        $now = Carbon::now();
        return $this->date->isSameDay($now); // Jika acara hanya 1 hari
        // Atau bisa juga:
        // return $this->date >= $now;
    }

    public function isFinished(): bool
    {
        return $this->date->lt(now()); // cek kalau tanggal event sudah lewat
    }
}
