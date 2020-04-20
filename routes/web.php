<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Frontend
    Route::redirect('/', 'search');
    Route::get('/search', 'SearchController@index')->name('search');

    // POST Requests
    Route::post('/search/movies', 'SearchController@searchMovies');
    Route::post('/movie/load/actions', 'MovieController@loadActions');
    Route::post('/movie/request', 'MovieController@request');
});
