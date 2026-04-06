<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = ['user_id', 'book_id', 'quantity'];

    /** Relasi: cart item milik satu user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi: cart item merujuk ke satu buku */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}