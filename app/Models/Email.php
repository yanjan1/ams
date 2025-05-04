<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $table = 'email';

    protected $fillable = ['sender_id', 'subject', 'body'];

    public function sender()
    {
        return $this->belongsTo(EmailId::class, 'sender_id');
    }

    public function receivers()
    {
        return $this->belongsToMany(
            EmailId::class,
            'email_receivers',
            'email_id',
            'receiver_id'
        );
    }
}
