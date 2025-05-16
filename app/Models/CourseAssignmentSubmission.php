<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseAssignmentSubmission extends Model
{
    protected $fillable = [
        'id_course_assignment',
        'id_student_course_enrollment',
        'file_path',
        'marks_obtained'
    ];

    /**
     * Get the assignment this submission is for.
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(CourseAssignment::class, 'id_course_assignment');
    }

    /**
     * Get the student enrollment this submission belongs to.
     */
    public function studentEnrollment(): BelongsTo
    {
        return $this->belongsTo(TermCourseClassEnrollment::class, 'id_student_course_enrollment');
    }
} 