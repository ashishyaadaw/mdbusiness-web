<?php

namespace App\Models;

use App\Models\Matters\Matter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function userServiceKey()
    {
        return $this->hasOne(UserServiceKey::class, 'user_id');
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }
    // In your User model

    public function getFcmKeyToken()
    {
        // The '?->' operator safely returns null if userServiceKey doesn't exist
        return $this->userServiceKey?->fcm_key;
    }

    public function getFullName()
    {
        // The '?->' operator safely returns null if userProfile doesn't exist
        return $this->userProfile?->full_name;
    }

    public function getPreferredLang()
    {
        // The '?->' operator safely returns null if userProfile doesn't exist
        return $this->userProfile?->preferred_lang;
    }

    // Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function matters()
    {
        return $this->hasMany(Matter::class, 'user_id');
    }
}
