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
Route::middleware('auth:api')->group(function(){


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cities','API\CityController@city');

Route::get('search','SearchController@api');

Route::get('availability','API\AvailablityController@check');

Route::post('roles','API\UserController@roles');

