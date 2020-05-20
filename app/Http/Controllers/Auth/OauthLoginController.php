<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Socialite;

class OauthLoginController extends Controller
{
    // driver accepted
    protected $accepted_driver = ['facebook', 'github'];

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        /** accpet only define driver */
        if (!in_array($driver, $this->accepted_driver)) return abort(404);

        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        /** accpet only define driver */
        if (!in_array($driver, $this->accepted_driver)) return abort(404);

        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return redirect()->route('auth.oauth', [$driver]);
        }

        // create account
        $authUser = $this->findOrCreateUser($user, $driver);

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
    private function findOrCreateUser($user, $driver)
    {
        if ($authUser = User::where('provider_id', $user->getId())->where('provider', $driver)->first()) {
            return $authUser;
        }

        // download avatar images and save to storage
        $avatar = $this->getAvatar($user);

        // generate
        $username = $user->getNickname();
        if ($username == null)
        {
            $username = str_replace(' ', '.', strtolower($user->getName()));
            while (User::whereUsername($username)->get()->count() > 0) {
                $rand = rand(1000, 9999);
                $username = str_replace(' ', '.', strtolower($user->getName())) . $rand;
            }
        }

        // create user
        return User::create([
            'name' => $user->getName(),
            'username' => $username,
            'email' => $user->getEmail(),
            'provider' => $driver,
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