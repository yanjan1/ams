<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LectureAttendance extends Model
{
    protected $table = 'lecture_attendence';

    protected $fillable = [
        'id_course_lecture',
        'id_student_course_enrollment',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Get the lecture this attendance record is for.
     */
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(CourseLecture::class, 'id_course_lecture');
    }

    /**
     * Get the student enrollment this attendance belongs to.
     */
    public function studentEnrollment(): BelongsTo
    {
        return $this->belongsTo(TermCourseClassEnrollment::class, 'id_student_course_enrollment');
    }
} 