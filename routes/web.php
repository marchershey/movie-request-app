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

Route::group(['middleware' => 'auth'], function () {

    // index
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/queue', 'QueueController@index')->name('index.queue');
    Route::get('/search', 'SearchController@index')->name('index.search');
    Route::get('/trending', function () {
        return view('trending');
    })->name('index.trending');

    // post requests
    Route::post('/movie/action/request', 'MovieController@action_request');
    Route::post('/movie/action/add', 'MovieController@action_add');
    Route::post('/movie/button/request', 'MovieController@button_request');

    // dashboard
    Route::get('/home', 'HomeController@index')->name('home');
});
