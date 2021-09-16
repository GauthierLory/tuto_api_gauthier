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

Route::group([
    'middleware' => 'api',
    'prefix' => 'users'

], function ($router){

    Route::get('/', 'UserController@index');
    Route::get('/{id}', 'UserController@show');
    Route::delete('/{id}', 'UserController@destroy');
    Route::patch('/{id}', 'UserController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'immeubles'

], function ($router){

    Route::get('/{user_id}', 'ImmeubleController@index');
    Route::get('/{id}/details', 'ImmeubleController@show');
    Route::post('/', 'ImmeubleController@store');
    Route::delete('/{id}', 'ImmeubleController@destroy');
    Route::patch('/{id}', 'ImmeubleController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'account'
], function ($router){

    Route::get('/', 'AccountController@index');
    Route::get('/{id}', 'AccountController@show');
    Route::post('/', 'AccountController@store');
    Route::delete('/{id}', 'AccountController@destroy');
    Route::patch('/{id}', 'AccountController@update');
});

Route::group([
    'middleware' => 'throttle:20,5',
    'prefix' => '/auth'

], function ($router) {
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');
});


Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', 'AuthController@me');
    Route::get('/auth/logout', 'AuthController@logout');
});
