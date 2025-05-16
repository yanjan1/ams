<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSchedule extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'id_program_term_course_class',
        'start_date',
        'end_date',
        'rrule',
        'exdate'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Get the class this schedule belongs to.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(ProgramTermCourseClass::class, 'id_program_term_course_class');
    }

    /**
     * Get all lectures in this schedule.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(CourseLecture::class, 'id_course_schedule');
    }
} 