<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1;
    const ARTIST_ROLE_ID = 2;
    const USER_ROLE_ID = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        if ($this->role_id == self::ADMIN_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function isArtist(): bool
    {
        if ($this->role_id == self::ARTIST_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function isUser(): bool
    {
        if ($this->role_id == self::USER_ROLE_ID) {
            return true;
        }
        return false;
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
