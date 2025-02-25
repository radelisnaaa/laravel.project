<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // protected $casts = [
    //     'date' => 'datetime',
    //     'price' => 'decimal:2',
    // ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')->withPivot('order_id')->withTimestamps();
        
    }
}
