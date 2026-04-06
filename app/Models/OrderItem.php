<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = ['order_id', 'book_id', 'quantity', 'price'];

    /** Relasi: item milik satu order */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /** Relasi: item merujuk ke satu buku */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}