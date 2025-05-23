<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'organization',
       
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi jika user memiliki banyak event.
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user')->withPivot('order_id');
    }
    
    public function history()
    {
        return $this->hasMany(History::class);
    }
}


