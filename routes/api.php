<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', 'api\v1\LoginController@login');
    Route::middleware(['auth:api'])->group(function () {
        Route::get('product/{id}', 'api\v1\ContentController@product');  //from barcode scanner
        Route::post('confirm', 'api\v1\ContentController@confirmSale');  //sell products
        Route::get('receipts', 'api\v1\ContentController@receipts');  //get today's receipts & receipts by number
        Route::get('customers/{name}', 'api\v1\ContentController@customers');  //get customers
        Route::post('payDebt/{id}', 'api\v1\ContentController@payDebt');  //Pay debt
        Route::get('incomes', 'api\v1\ContentController@incomes');  //get incomes
        Route::post('incomes/{id}', 'api\v1\ContentController@addIncome');  //add income
        Route::get('expenses', 'api\v1\ContentController@expenses');  //get expenses
        Route::post('expenses/{id}', 'api\v1\ContentController@addExpense');  //add expense
    });
});

