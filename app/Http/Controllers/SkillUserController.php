<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillUserController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skill = Skill::where('id', $request['skill_id'])->first();
        if ($skill) {
           $skillUser = $skill->users()->attach($request['user_id'], ['level' => $request['level'], 'time_skill_up' => $request['time_skill_up']]);
           if ($skillUser)
           {
                return redirect()->route('home')->with('success', 'update level successfully');
           } else {
                return redirect(url()->previous())->with('error', 'update level failed');
           }
        } else {
            return redirect(url()->previous())->with('error', 'Has error');
        }
    }

    public function showLevelHistory(Request $request)
    {
        $skillUser = DB::table('skill_user')
               ->where('user_id', $request['user_id'])
               ->where('skill_id', $request['skill_id'])
               ->orderBy('created_at', 'asc')
               ->get(['level', 'created_at']);

        return response()->json([
            'skill_user' => $skillUser,
        ], 200);
    }


}
