<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';
    protected $fillable = [
        'token',
        'user_id',
        'purpose',
        'expires_at',
        'is_used',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // make purpose strings as constants
    const PURPOSE_PASSWORD_RESET = 'password_reset';
    const PURPOSE_EMAIL_VERIFICATION = 'email_verification';
    const PURPOSE_ACCOUNT_ACTIVATION = 'account_activation';

}
