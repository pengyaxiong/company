<?php
Route::group(['prefix' => 'ads', 'namespace' => 'Ads', 'as' => 'ads.'], function () {
    //广告栏目
    Route::group(['prefix' => 'category'], function () {
        Route::patch('sort_order', 'CategoryController@sort_order')->name('category.sort_order');
        Route::patch('is_something', 'CategoryController@is_something')->name('category.is_something');
    });
    Route::resource('category', 'CategoryController');

    //广告
    Route::group(['prefix' => 'ad'], function () {
        Route::patch('sort_order', 'AdController@sort_order')->name('ad.sort_order');
        Route::delete('destroy_checked', 'AdController@destroy_checked')->name('ad.destroy_checked');
        Route::patch('is_something', 'AdController@is_something')->name('ad.is_something');

        //回收站
        Route::get('trash', 'AdController@trash')->name('ad.trash');
        Route::get('{ad}/restore', 'AdController@restore')->name('ad.restore');
        Route::delete('{ad}/force_destroy', 'AdController@force_destroy')->name('ad.force_destroy');
        Route::delete('force_destroy_checked', 'AdController@force_destroy_checked')->name('ad.force_destroy_checked');
        Route::post('restore_checked', 'AdController@restore_checked')->name('ad.restore_checked');
    });
    Route::resource('ad', 'AdController');
});