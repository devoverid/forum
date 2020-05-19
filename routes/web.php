<?php

use App\Models\Discussion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('pages.home'); })->name('home');
Route::get('/@{username}', 'ProfileController@index')->name('profile');
Route::get('/setting', 'SettingController@index')->name('setting');
Route::post('/setting', 'SettingController@update')->name('setting.update');

Route::resource('discussion', 'DiscussionController');
Route::post('comment/{type}/{slug}', 'CommentController@comment')->name('comment');
Route::delete('comment/{comment}', 'CommentController@delete')->name('comment.delete');

Route::get('auth/github', 'Auth\GithubLoginController@redirectToProvider')->name('auth.github');
Route::get('auth/github/callback', 'Auth\GithubLoginController@handleProviderCallback')->name('auth.github.callback');
Auth::routes(['verify' => true]);


Route::get('tes', function () { 
    // $discussion = Discussion::whereSlug('indonesia-highmaps-6803')->first();
    // dd($discussion->comments);
    // $store = $discussion->comments()->create([
    //     'user_id' => auth()->user()->id,
    //     'text' => 'awoeawkeawoekawoe'
    // ]);
});
// Route::get('/home', 'HomeController@index')->name('home');

//  LIVE HACK :V DONE
Route::get('avatar/{name}', function ($name) {
    $path = storage_path() . "/app/public/avatar/" . $name;
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
