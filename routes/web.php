<?php

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

Route::get('register','RegManagerController@register')->name('register');
Route::post('regnewclient','RegManagerController@registerNewClient');
Route::get('vrf/{id}','RegManagerController@verify');

Auth::routes();

Route::resource('product','ProductController');
Route::resource('client','ClientController');
Route::resource('user','UserController');
Route::resource('tenant','TenantController');

Route::get('/','HomeController@index')->name('home');
