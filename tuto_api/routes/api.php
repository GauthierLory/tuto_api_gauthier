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

    Route::get('list', 'UserController@index');
    Route::get('show/{id}', 'UserController@show');
    Route::delete('delete/{id}', 'UserController@destroy');
    Route::patch('edit/{id}', 'UserController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'immeubles'

], function ($router){

    Route::get('list', 'ImmeubleController@index');
    Route::get('show/{id}', 'ImmeubleController@show');
    Route::post('create', 'ImmeubleController@store');
    Route::delete('delete/{id}', 'ImmeubleController@destroy');
    Route::patch('edit/{id}', 'ImmeubleController@update');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});