<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Relationship: A department has many users (employees).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}