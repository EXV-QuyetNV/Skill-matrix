<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            $user = [
                'email' => $account->user->email,
                'password' => config('lesson.password'),
            ];

            return $user;
        } else {
            $email = $providerUser->getEmail() ?? $providerUser->getNickname();
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = User::whereEmail($email)->first();
            if (!$user) {
                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'password' => Hash::make(11111111),
                ]);
            }
            $data = [
                'email' => $user->email,
                'password' => 11111111,
            ];

            $account->user()->associate($user->id);
            $account->save();
            return $data;
        }
    }
}
