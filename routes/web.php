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


Route::get('/', 'IndexController@index')->name('index');
Route::get('/queue', 'QueueController@index')->name('index.queue');
Route::get('/search', 'SearchController@index')->name('index.search');
Route::get('/trending', function () {
    return view('trending');
})->name('index.trending');

Route::post('/movie/action/request', 'MovieController@action_request');
Route::post('/movie/action/vote', 'MovieController@action_vote');
Route::post('/movie/action/add', 'MovieController@action_add');
Route::post('/movie/button/request', 'MovieController@button_request');
Route::post('/movie/button/vote', 'MovieController@button_vote');
Route::post('/movie/get/votes', 'MovieController@get_votes');


////
// Route::post('/movie/store', 'MovieController@store');

//

Route::get('/home', 'HomeController@index')->name('home');
