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

Route::get('/', '\App\Http\Controllers\HomeController@search')
    ->name('home')
    ->middleware('customauthenticator');

Route::post('/tag/store', 'App\Http\Controllers\TagController@store')
->middleware('customauthenticator');

Route::post('/tag/update', 'App\Http\Controllers\TagController@update')
->middleware('customauthenticator');

Route::delete('/tag/{id}', 'App\Http\Controllers\TagController@destroy')
    ->middleware('customauthenticator');

Route::get('/tag', '\App\Http\Controllers\TagController@index')
    ->middleware('customauthenticator');

Route::get('/repo', '\App\Http\Controllers\RepoController@index')
->middleware('customauthenticator');

// Authentication
Route::get('/login', 'App\Http\Controllers\LoginController@index');
Route::post('/login', 'App\Http\Controllers\LoginController@login');

Route::get('/register', 'App\Http\Controllers\RegisterController@create');
Route::post('/register', 'App\Http\Controllers\RegisterController@store');

Route::get('/logout', function() {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/login');
});
