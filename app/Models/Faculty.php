<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faculty extends Model
{
    protected $fillable = [
        'name',
        'email',
        'aadhar_number',
        'faculty_address',
        'faculty_phone_no',
        'user_id'
    ];

    /**
     * Get the user that owns the faculty profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all classes taught by the faculty.
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            ProgramTermCourseClass::class,
            'program_term_course_class_faculty',
            'id_faculty',
            'id_program_term_course_class'
        );
    }
} 