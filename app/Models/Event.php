<?php

namespace App\Models;


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
}