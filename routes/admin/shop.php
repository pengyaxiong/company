<?php
Route::group(['prefix' => 'shop', 'namespace' => 'Shop', 'as' => 'shop.'], function () {
    Route::get('/', 'HomeController@mobile')->name('mobile');

    //商品品牌，除去show方法
    Route::group(['prefix' => 'brand'], function () {
        Route::delete('destroy_checked', 'BrandController@destroy_checked')->name('brand.destroy_checked');
        Route::patch('sort_order', 'BrandController@sort_order')->name('brand.sort_order');
        Route::patch('is_something', 'BrandController@is_something')->name('brand.is_something');
    });
    Route::resource('brand', 'BrandController', ['except' => ['show']]);


    //栏目管理
    Route::group(['prefix' => 'category'], function () {
        Route::patch('sort_order', 'CategoryController@sort_order')->name('category.sort_order');
        Route::patch('is_something', 'CategoryController@is_something')->name('category.is_something');
    });
    Route::resource('category', 'CategoryController');

    //商品管理
    Route::group(['prefix' => 'product'], function () {
        Route::patch('change_stock', 'ProductController@change_stock')->name('product.change_stock');
        Route::delete('destroy_checked', 'ProductController@destroy_checked')->name('product.destroy_checked');
        Route::delete('destroy_gallery', 'ProductController@destroy_gallery')->name('product.destroy_gallery');
        Route::patch('is_something', 'ProductController@is_something')->name('product.is_something');

        //回收站
        Route::get('trash', 'ProductController@trash')->name('product.trash');
        Route::get('/{product}/restore', 'ProductController@restore')->name('product.restore');
        Route::delete('/{product}/force_destroy', 'ProductController@force_destroy')->name('product.force_destroy');
        Route::delete('force_destroy_checked', 'ProductController@force_destroy_checked')->name('product.force_destroy_checked');
        Route::post('restore_checked', 'ProductController@restore_checked')->name('product.restore_checked');
    });
    Route::resource('product', 'ProductController');

    //会员管理
    Route::resource('customer', 'CustomerController');

    //物流运费
    Route::group(['prefix' => 'express'], function () {
        Route::patch('sort_order', 'ExpressController@sort_order')->name('express.sort_order');
        Route::patch('is_something', 'ExpressController@is_something')->name('express.is_something');
    });
    Route::resource('express', 'ExpressController');

    //订单管理
    Route::group(['prefix' => 'order'], function () {
        Route::patch('picking', 'OrderController@picking')->name('order.picking');
        Route::patch('shipping', 'OrderController@shipping')->name('order.shipping');
        Route::patch('finish', 'OrderController@finish')->name('order.finish');
    });
    Route::resource('order', 'OrderController');
});