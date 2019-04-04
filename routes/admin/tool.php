<?php
Route::group(['prefix' => 'tool', 'namespace' => 'Tool', 'as' => 'tool.'], function () {

    // 爬虫设置
    Route::group(['prefix' => 'spider'], function () {
        Route::delete('destroy_checked', 'SpiderController@destroy_checked')->name('spider.destroy_checked');
        Route::patch('is_something', 'SpiderController@is_something')->name('spider.is_something');

        //回收站
        Route::get('trash', 'SpiderController@trash')->name('spider.trash');
        Route::get('{spider}/restore', 'SpiderController@restore')->name('spider.restore');
        Route::delete('{spider}/force_destroy', 'SpiderController@force_destroy')->name('spider.force_destroy');
        Route::delete('force_destroy_checked', 'SpiderController@force_destroy_checked')->name('spider.force_destroy_checked');
        Route::post('restore_checked', 'SpiderController@restore_checked')->name('spider.restore_checked');
    });
    Route::resource('spider', 'SpiderController');

});