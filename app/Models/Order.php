<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = [
        'user_id', 'total_price', 'status',
        'shipping_address', 'phone', 'notes'
    ];

    /** Relasi: order milik satu user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi: order punya banyak item */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}