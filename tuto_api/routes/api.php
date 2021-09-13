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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'UserController@store');

Route::post('login', 'AuthController@login');


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

    Route::get('/', 'ImmeubleController@index');
    Route::get('/{id}', 'ImmeubleController@show');
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

    'middleware' => ['api','jwt.verify'],
    'prefix' => 'auth'

], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
