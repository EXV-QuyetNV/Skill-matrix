<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{

    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->stateless()->user(), $social);
        Auth::attempt($user);
        return redirect()->route('home');
    }
}
