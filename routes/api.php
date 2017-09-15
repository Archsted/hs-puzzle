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

Route::group(['prefix' => 'v1'], function () {
    Route::get('user/{userCode}/board/{boardCode?}', 'SinglePlayController@board');
    Route::post('user/{userCode}/board/{boardCode}/answers', 'BoardController@answer');
    Route::put('user/{userCode}', 'UserController@update');
});