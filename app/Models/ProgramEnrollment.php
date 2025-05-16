<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramEnrollment extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'id_student',
        'id_program',
        'status',
        'enrollment_date',
        'graduation_date'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'graduation_date' => 'date',
        'status' => 'string'
    ];

    /**
     * Get the student who is enrolled.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id_student');
    }

    /**
     * Get the program the student is enrolled in.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    /**
     * Get all term enrollments for this program enrollment.
     */
    public function termEnrollments(): HasMany
    {
        return $this->hasMany(TermEnrollment::class, 'id_program_enrollment');
    }
} 