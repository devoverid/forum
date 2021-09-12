<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscussionController;

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

/** pages */
Route::get('/', 'HomeController@index')->name('home');
Route::get('owner', 'OwnerController@index')->name('owner');


/** discussion */
Route::resource('discussion', 'DiscussionController');
Route::post('discussion/actions', [DiscussionController::class, 'actions'])->name('discussion.actions');
Route::put('discussion/best-answer/{discussion}/{comment}', [DiscussionController::class, 'best_answer_set'])->name('discussion.best_answer');
Route::delete('discussion/best-answer/{discussion}', [DiscussionController::class, 'best_answer_delete'])->name('discussion.best_answer.delete');


/** comment */
Route::post('comment/{type}/{slug}', 'CommentController@comment')->name('comment');
Route::delete('comment/{comment}', 'CommentController@delete')->name('comment.delete');


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
