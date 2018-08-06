<?php



Route::group(['prefix' => '/', 'namespace' => 'Hotels\Http\Controllers'], function()
{

    Route::get('/', 'HotelController@index');

    Route::post('convert', 'HotelController@convert');

});
