<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = ['user_id', 'name', 'email', 'message', 'is_read'];

    /** Relasi: pesan bisa dikirim oleh user (nullable) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}