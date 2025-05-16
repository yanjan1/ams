<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramTerm extends Model
{
    protected $fillable = [
        'name',
        'duration_in_months',
        'program_id'
    ];

    /**
     * Get the program that owns the term.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get all sessions of this term.
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(ProgramTermSession::class, 'id_program_term_id');
    }
} 