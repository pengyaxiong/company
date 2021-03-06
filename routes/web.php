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
Route::group(['middleware' => ['uv'], 'namespace' => 'Home', 'as' => 'home.', 'domain' => env('HOME_DOMAIN')], function () {

    //前台首页
    Route::get('/', 'HomeController@index')->name('index');
});

//微信商城前端'middleware' => ['wechat.oauth','wechat'],
Route::group(['namespace' => 'Wechat', 'prefix' => 'wechat', 'as' => 'wechat.'], function () {

    //微信商城
    require 'wechat/shop.php';
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
        //广告管理
        require "admin/ads.php";
        //消息管理
        require 'admin/information.php';

        Route::group(['prefix' => 'wechat', 'namespace' => 'Wechat', 'as' => 'wechat.'], function () {

            // 公众号设置
            Route::group(['prefix' => 'config'], function () {
                Route::get('/', 'ConfigController@edit')->name('config.edit');
                Route::put('/', 'ConfigController@update')->name('config.update');
            });
            //微信自定义菜单
            Route::group(['prefix' => 'menu'], function () {
                Route::get('edit', 'MenuController@edit')->name('menu.edit');
                Route::put('update', 'MenuController@update')->name('menu.update');
                Route::delete('destroy', 'MenuController@destroy')->name('menu.destroy');
            });
        });

    });
});

