<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramTermSession extends Model
{
    protected $fillable = [
        'id_program_term_id',
        'id_academic_session_id'
    ];

    /**
     * Get the term that owns this session.
     */
    public function term(): BelongsTo
    {
        return $this->belongsTo(ProgramTerm::class, 'id_program_term_id');
    }

    /**
     * Get the academic session this term session belongs to.
     */
    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'id_academic_session_id');
    }

    /**
     * Get all courses in this term session.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(ProgramTermSessionCourse::class, 'id_program_term_session');
    }

    /**
     * Get all enrollments in this term session.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(TermEnrollment::class, 'term_session_id');
    }
} 