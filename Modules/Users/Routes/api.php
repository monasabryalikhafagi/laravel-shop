<?php

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

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

Route::get('/users', function (Request $request) {

     return response()->json($request->getClientIp(true), 200);
});
Route::group([
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthApiController@register');
    Route::post('login', 'AuthApiController@login');
    Route::post('logout', 'AuthApiController@logout');
    Route::post('/social-login/{provider}', 'AuthApiController@socialLogin');
    Route::group(['middleware'=>'auth:api'],function() {
        Route::get('/profile', 'UsersApiController@getProfile');
        Route::post('/post-profile', 'UsersApiController@postProfile');
    });



});
