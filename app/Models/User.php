<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',       // admin / user
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Перевірка: чи користувач — адмін
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Зв’язок "улюблені"
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
