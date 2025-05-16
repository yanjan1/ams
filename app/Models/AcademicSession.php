<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicSession extends Model
{
    protected $table = 'acedemic_session';
    
    protected $fillable = [
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Get all program term sessions in this academic session.
     */
    public function termSessions(): HasMany
    {
        return $this->hasMany(ProgramTermSession::class, 'id_academic_session_id');
    }
} 