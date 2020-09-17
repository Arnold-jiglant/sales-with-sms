<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', 'api\v1\LoginController@login');
    Route::middleware(['auth:api'])->group(function () {
        Route::get('product/{id}', 'api\v1\ContentController@product');  //from barcode scanner
        Route::post('confirm','api\v1\ContentController@confirmSale');  //sell products
        Route::get('receipts', 'api\v1\ContentController@receipts');  //get today's receipts
        Route::get('receipt/{number}', 'api\v1\ContentController@receipt');  //get receipts by number
        Route::get('customers/{name}', 'api\v1\ContentController@customers');  //get customers
    });
});
