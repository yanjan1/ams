<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Auth\User as Autheticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Autheticatable
{
    use Notifiable;
    protected $table = 'user';
    protected $fillable = [
        'email',
        'active',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
