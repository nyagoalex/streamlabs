<?php

namespace App\Http\Controllers\Auth;

use App\Actions\FindOrCreateUserAction;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {

        return Inertia::render('Auth/Login');
    }

    public function twitch()
    {
        return Socialite::driver('twitch')
            ->scopes(['user:read:follows', 'user:read:email'])
            ->redirect();
    }


    public function twitchRedirect(): RedirectResponse
    {
        $auth = Socialite::driver('twitch')->user();

        $user = (new FindOrCreateUserAction())($auth);

        auth()->login($user);

        return redirect()->route('home');
    }


    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('auth.login');
    }
}
