<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/notifications', function () {

    return view('notifications.index');
});
Route::get('/notifications/get-notifications', function () {

    return response()->json(['notifications'=>auth()->user()->notifications], 200);
});
Route::get('/test-notification','\Modules\Users\Http\Controllers\UsersController@testNotification');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
