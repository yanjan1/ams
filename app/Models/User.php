<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Autheticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Autheticatable
{
    use Notifiable, HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'email',
        'active',
        'is_login_allowed',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
        'is_login_allowed' => 'boolean',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    
}
