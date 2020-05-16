<?php

use Illuminate\Support\Facades\Route;

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

Route::get('auth/github', 'Auth\GithubLoginController@redirectToProvider')->name('auth.github');
Route::get('auth/github/callback', 'Auth\GithubLoginController@handleProviderCallback')->name('auth.github.callback');
Auth::routes(['verify' => true]);


// Route::get('tes', function () { return view('auth.passwords.confirm'); });
// Route::get('/home', 'HomeController@index')->name('home');

