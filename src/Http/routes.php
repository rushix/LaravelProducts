<?php

Route::group(['middleware' => 'web'], function () {
    Route::resource('products', '\Rushix\LaravelProducts\Http\LaravelProductsController');
});
