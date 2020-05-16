<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::whereUsername($username)->first();
        if (!$user) return abort(404);

        return view('pages.profile.index', compact('user'));
    }
}
