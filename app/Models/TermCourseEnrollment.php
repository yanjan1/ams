<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TermCourseEnrollment extends Model
{
    protected $fillable = [
        'id_term_enrollment',
        'id_program_term_session_course',
        'enrollment_date',
        'status'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'status' => 'string'
    ];

    /**
     * Get the term enrollment this course enrollment belongs to.
     */
    public function termEnrollment(): BelongsTo
    {
        return $this->belongsTo(TermEnrollment::class, 'id_term_enrollment');
    }

    /**
     * Get the session course this enrollment is for.
     */
    public function sessionCourse(): BelongsTo
    {
        return $this->belongsTo(ProgramTermSessionCourse::class, 'id_program_term_session_course');
    }

    /**
     * Get all class enrollments for this course enrollment.
     */
    public function classEnrollments(): HasMany
    {
        return $this->hasMany(TermCourseClassEnrollment::class, 'id_term_enrollment_course');
    }
} 