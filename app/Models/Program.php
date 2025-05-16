<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = [
        'name',
        'department_id'
    ];

    /**
     * Get the department that owns the program.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all terms in the program.
     */
    public function terms(): HasMany
    {
        return $this->hasMany(ProgramTerm::class);
    }

    /**
     * Get all enrollments in the program.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(ProgramEnrollment::class, 'id_program');
    }
} 