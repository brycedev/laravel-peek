<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::group(['name' => 'requests.', 'prefix' => 'requests'], function () {
    Route::get('/', 'RequestRecordsController@index')->name('index');
    Route::get('/{requestRecord}', 'RequestRecordsController@show')->name('show');
});
