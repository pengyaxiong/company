<?php

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


//前台
Route::group(['middleware' => ['uv'],'namespace' => 'Home','as' => 'home.', 'domain' => env('HOME_DOMAIN')], function () {

    //前台首页
    Route::get('/', 'HomeController@index')->name('index');
});

//后台
Route::group(['domain' => env('ADMIN_DOMAIN')], function () {
    //登录注册
    Auth::routes();

    Route::group(['middleware' => ['auth', 'sidebar', 'role'], 'namespace' => 'Admin'], function () {

        //后台首页
        Route::get('/admin', 'HomeController@index')->name('admin');
        //商城管理
        require 'admin/shop.php';
        //工具管理
        //require 'admin/tool.php';
        //内容管理
        require 'admin/cms.php';
        //系统管理
        require 'admin/system.php';

        //消息管理
        require 'admin/information.php';
    });
});

