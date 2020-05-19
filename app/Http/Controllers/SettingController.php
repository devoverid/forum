<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if (auth()->check()) return "LO BELOM LOGIN!";
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

        /**
         * Check for avatar update
         */
        if ($request->has('avatar'))
        {
            /**
             * Set Role for avatar image upload
             * Poho extensions that can be used are
             * jpeg - png - gif -webp - jpg
             * 
             * Max size are 
             * 2048kb
             * 
             * @var     | array
             * @return  | array
             */
        
            $request->validate(['avatar' => 'required|file|mimes:jpeg,png,gif,webp,jpg|max:2048']);

            /**
             * Change the real name of image
             * example : XIEOblY4Gp1589914852.jpg
             */
            $avatar = $request->avatar;
            $ext = '.' . $avatar->getClientOriginalExtension();
            $generate_name = Str::random(10) . Carbon::now()->timestamp . $ext;

            /**
             * Upload file image to storage
             * Located in app/upload
             */
            $path = storage_path('app/public/avatar/');
            $image = Image::make($avatar->getRealPath())
                ->fit(460, 460)->save($path . $generate_name);
                
            /**
             * Set avatar variable
             */
            $data['avatar'] = $generate_name;
        }

        /**
         * Update to database.
         */
        $update = $user->update($data);

        
        /** 
         * Redirect to setting route
         */
        return redirect()->route('setting');
    }
}
