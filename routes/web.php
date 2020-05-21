<?php

use App\Models\Discussion;
use HTMLMin\HTMLMin\Facades\HTMLMin;
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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('discussion', 'DiscussionController');
Route::post('comment/{type}/{slug}', 'CommentController@comment')->name('comment');
Route::delete('comment/{comment}', 'CommentController@delete')->name('comment.delete');

Route::get('owner', 'OwnerController@index')->name('owner');

/** avatar image from storage */
Route::get('avatar/{name}', function ($name) {
    $path = storage_path() . "/app/public/avatar/" . $name;
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

/** profile */
Route::get('/@{username}', 'ProfileController@index')->name('profile');
Route::get('/setting', 'SettingController@index')->name('setting');
Route::post('/setting', 'SettingController@update')->name('setting.update');

/** auth */
Auth::routes(['verify' => true]);
Route::get('auth/{driver}', 'Auth\OauthLoginController@redirectToProvider')->name('auth.oauth');
Route::get('auth/{driver}/callback', 'Auth\OauthLoginController@handleProviderCallback')->name('auth.oauth.callback');