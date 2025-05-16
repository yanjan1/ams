<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DEO extends Model
{
    protected $table = 'DEO';

    protected $fillable = [
        'name',
        'email',
        'aadhar_number',
        'deo_address',
        'deo_phone_no',
        'user_id'
    ];

    /**
     * Get the user that owns the DEO profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 