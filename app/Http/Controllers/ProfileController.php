<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username)
    {
        // get user by get username
        $user = User::whereUsername($username)->first();

        // if null return 404
        if (!$user) return abort(404);

        // get activity timeline user
        $activities = $this->handleActivity($user);

        // return
        return view('pages.profile.index', compact('user', 'activities'));
    }

    protected function handleActivity($user)
    {
        // get discussion create activity
        $activities = Discussion::whereUserId($user->id)->get();


        // get comment activity


        // return
        return $activities;
    }
}
