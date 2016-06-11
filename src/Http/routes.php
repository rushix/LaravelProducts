<?php

Route::group(['middleware' => 'web'], function () {
    Route::resource('products', '\rushix\LaravelProducts\Http\LaravelProductsController');
});
