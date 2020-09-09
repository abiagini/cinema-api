<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('logout', 'AuthController@logout')->middleware('auth:api');
});

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'movies'], function () {
        Route::get('', 'MovieController@index');
        Route::post('', 'MovieController@store');
        Route::put('{movie}', 'MovieController@update');
    });
});

