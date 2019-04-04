<?php
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {

    Route::post('check_login', 'LoginController@check_login')->name('check_login');

    Route::get('test', 'LoginController@test')->name('test');

});