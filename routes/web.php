<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Index
    Route::get('/', 'IndexController@index')->name('index');

    // Search
    Route::group(['prefix' => 'search'], function () {
        Route::get('/', 'SearchController@index')->name('search');
        Route::post('/movies', 'SearchController@searchMovies');
    });

    // User Dashboard Route
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'namespace' => 'Dashboard'], function () {
        Route::get('/settings', 'SettingsController@settings')->name('settings');
    });

    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
        //
    });

    // POST Requests
    Route::post('/movie/load/actions', 'MovieModalController@loadActions');
    Route::post('/movie/request', 'MovieModalController@request');
});
