<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $ticket_id
 * @property int $quantity
 * @property float $total_price
 * @property string $status
 * @property \App\Models\User $user
 * @property \App\Models\Ticket $ticket
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'quantity',
        'total_price',
        'status',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'total_price' => 'float',
    ];

    /**
     * Enum values (untuk referensi)
     * pending, paid, cancelled
     */

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Ticket
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
