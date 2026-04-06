<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = ['name', 'slug'];

    /** Relasi: satu kategori punya banyak buku */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}