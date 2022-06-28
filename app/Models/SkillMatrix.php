<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillMatrix extends Model
{
    use HasFactory, Timestamp;

    protected $fillable = [
        'status',
    ];

    public function skill_matrix()
    {
        return $this->hasMany(UserSkill::class);

    }
}
