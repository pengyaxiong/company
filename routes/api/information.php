<?php
Route::group(['prefix' => 'information', 'namespace' => 'Information', 'as' => 'information.'], function () {

    Route::post('contact', 'ContactController@store')->name('contact');

});