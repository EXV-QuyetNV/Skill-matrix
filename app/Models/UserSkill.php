<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $fillables = [
        'user_id',
        'skill_id',
    ];

    public function skillMatrix()
    {
        return $this->hasOne(SkillMatrix::class);
    }
}
