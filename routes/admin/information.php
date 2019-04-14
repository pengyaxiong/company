<?php
Route::group(['prefix' => 'information', 'namespace' => 'Information', 'as' => 'information.'], function () {

    Route::resource('contact', 'ContactController');

//    Route::resource('chat', 'ChatController');
//
//    Route::group(['prefix' => 'room'], function () {
//        Route::delete('destroy_checked', 'RoomController@destroy_checked')->name('room.destroy_checked');
//
//        //回收站
//        Route::get('trash', 'RoomController@trash')->name('room.trash');
//        Route::get('{room}/restore', 'RoomController@restore')->name('room.restore');
//        Route::delete('{room}/force_destroy', 'RoomController@force_destroy')->name('room.force_destroy');
//        Route::delete('force_destroy_checked', 'RoomController@force_destroy_checked')->name('room.force_destroy_checked');
//        Route::post('restore_checked', 'RoomController@restore_checked')->name('room.restore_checked');
//    });
//
//    Route::resource('room', 'RoomController');

});