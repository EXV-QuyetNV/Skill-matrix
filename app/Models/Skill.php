<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('level')->withTimestamps();
    }

    public function getLatestUserLevel($userID)
    {
        $skillUser = DB::table('skill_user')
        ->where('user_id', $userID)
        ->where('skill_id', $this->id)
        ->orderBy('created_at', 'desc')->pluck('level')->first();

        return $skillUser;
    }

    public function getColorForLevel($userID)
    {
        $level = $this->getLatestUserLevel($userID);

        if (is_null($level)) {
            return 'none';
        } else {
            switch ($level) {
                case -1: return '#808080'; break;
                case 0: return '#EE82EE'; break;
                case 1: return '#FFB6C1'; break;
                case 2: return '#FF1493'; break;
                case 3: return '#90EE90'; break;
                case 4: return '#9ACD32'; break;
                case 5: return '#00BFFF'; break;
            }
        }
    }
}
