<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    protected $fillable = [
        'number',
        'building_id',
        'capacity',
        'type'
    ];

    protected $casts = [
        'type' => 'string'
    ];

    /**
     * Get the building that owns the classroom.
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    /**
     * Get all lectures scheduled in this classroom.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(CourseLecture::class, 'id_classroom');
    }
} 