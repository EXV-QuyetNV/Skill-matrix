<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $skills = Skill::all();
        $users = User::all();
        return view('home.index', compact(['skills', 'users']));
    }
}
