<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi (adjust sesuai dengan struktur tabel Anda)
    protected $fillable = ['user_id', 'event_id', 'action', 'created_at'];

    // Relasi ke User (bila History memiliki user_id yang merujuk ke User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
