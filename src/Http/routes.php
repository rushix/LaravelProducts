<?php

Route::group(['middleware' => 'web'], function () {
    Route::resource('products', '\Rushi\Products\Http\ProductsController');
});
