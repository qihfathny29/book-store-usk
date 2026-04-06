<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = [
        'category_id', 'title', 'author',
        'description', 'price', 'stock', 'image'
    ];

    /** Relasi: buku milik satu kategori */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** Relasi: buku bisa ada di banyak cart */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /** Relasi: buku bisa ada di banyak order */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}