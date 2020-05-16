<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('pages.profile.setting', compact('user'));
    }

    public function update(Request $request)
    {
        // user
        $user = auth()->user();

        // validate
        $request->validate([ 'name' => 'required|string|max:255' ]);
        $data['name'] = $request->name;

        // check update email
        if ($request->has('email') && $request->email != $user->email )
        {
            $request->validate(['email' => 'required|string|email|max:255|unique:users']);
            $data['email'] = $request->email;
        }

        // check update username
        if ($request->has('username') && $request->username != $user->username )
        {
            $request->validate(['username' => 'required|string|max:26|unique:users']);
            $data['username'] = $request->username;
        }

        // update
        $update = $user->update($data);
        
        // return
        return redirect()->route('setting');
    }
}
