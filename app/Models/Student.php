<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'aadhar_number',
        'parent_name',
        'stundent_address',
        'student_phone_no',
        'user_id'
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all program enrollments for the student.
     */
    public function programEnrollments(): HasMany
    {
        return $this->hasMany(ProgramEnrollment::class, 'id_student');
    }
} 