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
    'prefix' => 'products'

], function () {

Route::get('/', 'ProductsApiController@getAllProducts');
Route::get('/show/{id}', 'ProductsApiController@getProduct');
Route::post('/create', 'ProductsApiController@AddProduct');
});

