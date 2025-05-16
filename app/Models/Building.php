<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name'];

    /**
     * Get all classrooms in the building.
     */
    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
} 