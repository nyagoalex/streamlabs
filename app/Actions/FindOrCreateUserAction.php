<?php


namespace App\Actions;


use App\Models\User;

class FindOrCreateUserAction
{
    public function __invoke($auth): User
    {
        $user = $auth->user;

        return User::updateOrCreate(['twitch_id' => $user['id']],
            [
                'name' => $user['display_name'],
                'username' => $user['login'],
                'email' => $user['email'],
                'token' => $auth->token,
                'profile_image_url' => $user['profile_image_url']
            ]);
    }
}
