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

Route::group(['namespace'=>'Api','middleware'=>'ApiSign'], function () {
    Route::group(['prefix'=>'v1/user','namespace'=>'User\V1'], function () {
        //完成训练军队
        Route::post('/add', 'UserController@add');
    });
});
