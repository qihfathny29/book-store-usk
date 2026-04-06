<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory;

    /** Kolom yang boleh diisi secara massal */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address'
    ];

    /** Kolom yang disembunyikan saat serialisasi */
    protected $hidden = ['password'];

    /** Cek apakah user adalah admin */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /** Relasi: user punya banyak cart item */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /** Relasi: user punya banyak order */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /** Relasi: user punya banyak pesan */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}