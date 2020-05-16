<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Socialite;

class GithubLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect()->route('auth.github');
        }

        // create account
        $authUser = $this->findOrCreateUser($user);

        // auto login user 
        Auth::login($authUser, true);

        // redirect
        return redirect()->route('profile', [$authUser->username]);
    }


    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($user)
    {
        if ($authUser = User::where('provider_id', $user->getId())->where('provider', 'github')->first()) {
            return $authUser;
        }

        // download avatar images and save to storage
        $avatar = $this->getAvatar($user);

        // create user
        return User::create([
            'name' => $user->getName(),
            'username' => $user->getNickname(),
            'email' => $user->getEmail(),
            'provider' => 'github',
            'provider_id' => $user->getId(),
            'avatar' => $avatar
        ]);
    }

    private function getAvatar($user)
    {
        $url = $user->getAvatar();
        $contents = file_get_contents($url);
        $path = 'public/avatar/';
        $name = $user->getId() . '.jpeg';
        Storage::put($path . $name, $contents);

        // return name
        return $name;
    }
}