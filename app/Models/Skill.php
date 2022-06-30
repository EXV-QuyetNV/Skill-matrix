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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('level');
    }

    public function getLevelByUser($userID)
    {
        return $this->users()->where('user_id', $userID)->pluck('level')->first();
    }

    public function getColorForLevel($userID)
    {
        $level = $this->getLevelByUser($userID);
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
