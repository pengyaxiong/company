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


Route::group(['domain' => env('ADMIN_DOMAIN'), 'namespace' => 'Api', 'as' => 'api.'], function () {

    //用户管理
    require 'api/user.php';
    //消息管理
    require 'api/information.php';
    //系统管理
    require 'api/system.php';
});