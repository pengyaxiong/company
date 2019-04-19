<?php

//首页
Route::get('/', 'IndexController@index');

//搜索
Route::get('/search', 'ProductController@search');

Route::group(['prefix' => 'product'], function () {
    //商品分类
    Route::get('category', 'ProductController@category');

    //商品详情
    Route::get('{id}', 'ProductController@show');

    //商品列表
    Route::get('/', 'ProductController@index');
});

//购物车
Route::group(['prefix' => 'cart'], function () {
    Route::post('/', 'CartController@store');
    Route::get('/', 'CartController@index');
    Route::delete('/', 'CartController@destroy');
    Route::patch('/', 'CartController@change_num');
});

//订单
Route::group(['prefix' => 'order'], function () {
    //订单列表
    Route::get('/', 'OrderController@index');

    //下单
    Route::get('checkout', 'OrderController@checkout');
    //付款
    Route::post('pay', 'OrderController@pay');
    //删除订单
    Route::delete('/', 'OrderController@destroy');
});

//地址管理
Route::group(['prefix' => 'address'], function(){
   //改变默认地址
    Route::patch('/', 'AddressController@default_address');
    //地址管理
    Route::get('/manage', 'AddressController@manage');
});

Route::resource('address', 'AddressController');


//个人中心
Route::group(['prefix' => 'customer'], function () {
    Route::get('/', 'CustomerController@index');
});

//反馈消息
Route::group(['prefix' => 'contact'], function () {
    Route::post('/', 'ContactController@store');
    Route::get('/', 'ContactController@index');
});

//幸运大抽奖
Route::group(['prefix' => 'draw'], function () {
    //加载抽奖页面
    Route::get('/', 'DrawController@index');

    //抽奖记录添加到数据库
    Route::post('/', 'DrawController@store');
});











