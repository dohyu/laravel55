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
        // try {
            $user = Socialite::driver($provider)->user();
            $input['name'] = $user->getName();
            $input['email'] = $user->getEmail();
            $input['provider'] = $provider;
            $input['provider_id'] = $user->getId();

            $authUser = $this->findOrCreate($input);
            auth()->login($authUser);

            return redirect($this->redirectTo);
        // } catch (Exception $e) {
        //     return redirect('auth/' . $provider);
        // }
    }

    public function findOrCreate($input)
    {
        $user = \App\User::where('provider', $input['provider'])
            ->where('provider_id', $input['provider_id'])
            ->first();

        if ($user) {
            return $user;
        } else {
            return \App\User::create($input);
        }
    }
}
