<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailId extends Model
{
    protected $table = 'email_ids';

    protected $fillable = ['owner_name', 'email'];

    public function sentEmails()
    {
        return $this->hasMany(Email::class, 'sender_id');
    }

    public function receivedEmails()
    {
        return $this->belongsToMany(
            Email::class,
            'email_receivers',
            'receiver_id',
            'email_id'
        );
    }
}
