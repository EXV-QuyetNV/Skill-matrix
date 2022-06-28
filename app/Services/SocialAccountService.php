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
                'username' => $account->user->username,
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
                    'username' => $providerUser->getName(),
                    'password' => Hash::make(config('lesson.password')),
                    'avatar' => $providerUser->getAvatar(),
                    'role' => config('lesson.zero'),
                ]);
            }
            $data = [
                'username' => $user->username,
                'password' => config('lesson.password'),
            ];

            $account->user()->associate($user->id);
            $account->save();
            return $data;
        }
    }
}
