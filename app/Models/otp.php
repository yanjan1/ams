<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    protected $table = 'otp';
    protected $fillable = [
        'email',
        'otp',
        'is_verified',
        'created_at',
        'expires_at',
        'purpose'
    ];

    public $timestamps = false;

    // Define the purpose constants
    const PURPOSE_ACTIVATE_ACCOUNT = 'activate_account';
    const PURPOSE_RESET_PASSWORD = 'reset_password';

    protected $casts = [
        'created_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->expires_at = now()->addMinutes(5);
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

}
