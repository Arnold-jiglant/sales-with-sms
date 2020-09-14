<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', 'api\v1\LoginController@login');
    Route::middleware(['auth:api'])->group(function (){
        Route::get('product/{id}','api\v1\ContentController@product');  //from barcode scanner
    });
});
