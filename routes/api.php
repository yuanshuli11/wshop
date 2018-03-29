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
        Route::post('/add', 'UserController@add');
        Route::post('/login', 'UserController@login');

        Route::group(['middleware'=>'UserLogin'], function () {
            Route::get('/getinfo', 'UserController@userinfo');
        });
    });




    Route::group(['prefix'=>'v1/config','namespace'=>'Config\V1'],function () {
        Route::post('/initdata', 'InitDataController@initdata');
    });

});

Route::group(['prefix'=>'v1/utils','namespace'=>'Api\Utils\V1','middleware'=>'CheckApiToken'],function () {

    Route::post('/uploadFile', 'FileController@uploadFile');

});