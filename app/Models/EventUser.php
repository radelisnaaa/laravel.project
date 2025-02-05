<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $table = 'event_users';

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relasi dengan model event

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    //relasi dengan model user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
