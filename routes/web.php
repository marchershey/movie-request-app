<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Frontend
    Route::get('/', 'IndexController@index')->name('index');

    // User
    Route::get('/home', 'HomeController@index')->name('home');

    // Admin
    Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', 'IndexController@index')->name('index');
    });

    // POST Requests
    Route::post('/request/{id}', 'MovieController@request');
    Route::post('/search/tmdb', 'MovieController@searchTmdb');
    Route::post('/search/tmdb/videos', 'MovieController@searchTmdbVideos');
});
