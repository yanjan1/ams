<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramTermSessionCourse extends Model
{
    protected $fillable = [
        'id_program_term_session',
        'id_course',
        'course_type',
        'syllabus',
        'credits'
    ];

    protected $casts = [
        'course_type' => 'string'
    ];

    /**
     * Get the term session this course belongs to.
     */
    public function termSession(): BelongsTo
    {
        return $this->belongsTo(ProgramTermSession::class, 'id_program_term_session');
    }

    /**
     * Get the base course this term session course is based on.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    /**
     * Get all classes for this course.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ProgramTermCourseClass::class, 'id_program_term_session_course');
    }

    /**
     * Get all enrollments in this course.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(TermCourseEnrollment::class, 'id_program_term_session_course');
    }
} 