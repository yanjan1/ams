<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $table = "role";

    protected $fillable = [
        "name"
    ];
    

    // Define the many-to-many relationship with User
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}

