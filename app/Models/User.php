<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'email',
        'password',
        'jenis',
        'foto',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor untuk nama (mengubah ke format Title Case)
     */
    public function getNamaAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Jika user tidak memiliki foto, berikan foto default
     */
    public function getFotoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('assets/default.jpg');
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }
    
    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }
    
}
