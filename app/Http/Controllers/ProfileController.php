<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username)
    {
        // activites show
        $activity_tab = request()->get('activity', 'discussion');
        

        // get user by get username
        $user = User::whereUsername($username)->first();

        // if null return 404
        if (!$user) return abort(404);

        // get activity timeline user
        $activities = $this->handleActivity($user, $activity_tab);

        // return
        return view('pages.profile.index', compact('user', 'activities'));
    }

    protected function handleActivity($user, $activity_tab)
    {
        $activities = [];

        // get comment activity
        if ($activity_tab == 'comment')
        {
            $activities = Comment::whereUserId($user->id)->get();
        }

        // get discussion create activity
        if ($activity_tab == 'discussion')
        {
            $activities = Discussion::whereUserId($user->id)->get();
        }

        // return
        return $activities;
    }
}
