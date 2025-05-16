<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseLecture extends Model
{
    protected $fillable = [
        'id_course_schedule',
        'date',
        'start_time',
        'end_time',
        'id_classroom'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    /**
     * Get the schedule this lecture belongs to.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(CourseSchedule::class, 'id_course_schedule');
    }

    /**
     * Get the classroom where this lecture is held.
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'id_classroom');
    }

    /**
     * Get all attendance records for this lecture.
     */
    public function attendance(): HasMany
    {
        return $this->hasMany(LectureAttendance::class, 'id_course_lecture');
    }
} 