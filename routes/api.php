<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('loginPSC', 'AuthController@loginPSC')->name('loginPSC');
    Route::post('refresh-token', 'AuthController@refreshToken')->name('refreshToken');
    Route::post('check-email','AuthController@checkemail')->name('check-email');
    Route::post('checkuserDB','AuthController@checkuserDB')->name('checkuserDB');
    Route::post('send-job','MapController@sendJob')->name('send-job');
    Route::post('getjobupdates','MapController@getJobUpdates');
    Route::post('build-index','AuthController@buildIndexes')->name('build-index');
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('user','AuthController@user')->name('user');
    Route::get('products', 'AuthController@products')->name('products');
});