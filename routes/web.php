<?php

// prefix = /{prefix}/
// as = names ({as}.page)
// namespace = Controllers Within The "App\Http\Controllers\{namespace}" Namespace

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Index
Route::group(['prefix' => '', 'as' => 'index.', 'namespace' => 'Index'], function () {
    Route::get('/', 'PagesController@index')->name('index');
});

Route::group(['middleware' => 'auth'], function () {
    // Dashboard
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard'], function () {
        Route::get('/', 'PagesController@index')->name('index');
        Route::get('/search', 'PagesController@search')->name('search');
        Route::get('/trending', 'PagesController@trending')->name('trending');
        Route::get('/settings', 'PagesController@settings')->name('settings');
    });

    // Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::get('/', 'PagesController@index')->name('index');
    });

    // POST Requests
    Route::post('/api/search/movies', 'Dashboard\SearchController@searchMovies');
    Route::post('/movie/load/actions', 'MovieModalController@loadActions');
    Route::post('/movie/request', 'MovieModalController@request');
});
