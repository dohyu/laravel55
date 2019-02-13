<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;

class SocialAuthController extends Controller
{
    protected $redirectTo = '/home';

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $name = $user->getName()
            ?: $user->getNickname()
            ?: 'unknown';

        $user = (\App\User::whereEmail($user->getEmail())->first())
            ?: \App\User::create([
                'name' => $name,
                'email' => $user->getEmail(),
                'provider' => $provider,
                'provider_id' => $user->getId()
            ]);

        auth()->login($user);

        return redirect($this->redirectTo);
    }

    // public function findOrCreate($input)
    // {
    //     $user = \App\User::where('provider', $input['provider'])
    //         ->where('provider_id', $input['provider_id'])
    //         ->where('email', $input['email'])
    //         ->first();

    //     if ($user) {
    //         return $user;
    //     } else {
    //         return \App\User::create($input);
    //     }
    // }
}
