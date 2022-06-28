<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory, Timestamp;

    protected $fillable = [
        'name',
    ];

    public function Users()
    {
        return $this->belongsToMany(User::class)->withPivot('skill_matrix');
    }
}
