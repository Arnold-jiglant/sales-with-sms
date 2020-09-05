<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    if (\Illuminate\Support\Facades\DB::table('users')->count() > 0) {
        return redirect('login');
    } else {
        return redirect()->route('startup.wizard');
    }
});

//Startup Wizard
Route::prefix('setup')->group(function () {
    Route::get('wizard', 'WizardController@index')->name('startup.wizard');
    Route::post('new/user', 'WizardController@newUser')->name('startup.new.user');
});


Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        Session::put('language', \auth()->user()->languageName);
        return \auth()->user()->isManager ? redirect()->route('dashboard') : view('layout.app');
    })->name('home');

    //Configuration
    Route::get('configure', 'ConfigurationController@index')->name('configure');
    Route::post('configure/sell/method', 'ConfigurationController@changeSellMethod')->name('sellMethod');
    Route::post('add/expense/type', 'ConfigurationController@addExpenseType')->name('addExpenseType');
    Route::put('update/expense/type/{id}', 'ConfigurationController@updateExpenseType')->name('updateExpenseType');
    Route::delete('delete/expense/type/{id}', 'ConfigurationController@deleteExpenseType')->name('deleteExpenseType');
    Route::post('add/income/type', 'ConfigurationController@addIncomeType')->name('add.income.type');
    Route::put('update/income/type/{id}', 'ConfigurationController@updateIncomeType')->name('update.income.type');
    Route::delete('delete/income/type/{id}', 'ConfigurationController@deleteIncomeType')->name('delete.income.type');
    Route::get('add/role', 'ConfigurationController@viewAddRoleForm')->name('addRole');
    Route::post('add/role', 'ConfigurationController@addRole')->name('addRole');
    Route::get('edit/role/{id}', 'ConfigurationController@editRole')->name('editRole');
    Route::put('edit/role/{id}', 'ConfigurationController@updateRole')->name('editRole');
    Route::delete('delete/role/{id}', 'ConfigurationController@deleteRole')->name('deleteRole');
    Route::post('edit/database/backup', 'ConfigurationController@databaseBackup')->name('database.backup');

    //User
    Route::get('users', 'UserController@index')->name('users');
    Route::post('user/add', 'UserController@add')->name('user.add');
    Route::put('user/update/{id}', 'UserController@update')->name('user.update');
    Route::put('user/reset/{id}', 'UserController@reset')->name('user.reset');
    Route::put('user/change/password', 'UserController@changePassword')->name('user.change.password');
    Route::delete('user/delete/{id}', 'UserController@delete')->name('user.delete');

    //Product
    Route::get('products', 'ProductController@index')->name('products');
    Route::post('product/add', 'ProductController@add')->name('product.add');
    Route::put('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::delete('product/delete/{id}', 'ProductController@delete')->name('product.delete');

    //Customer
    Route::get('customers', 'CustomerController@index')->name('customers');
    Route::get('get/customers', 'CustomerController@show')->name('customers.get');
    Route::post('customer/add', 'CustomerController@add')->name('customer.add');
    Route::get('customer/view/{id}', 'CustomerController@view')->name('customer.view');
    Route::put('customer/update/{id}', 'CustomerController@update')->name('customer.update');
    Route::put('customer/pay/debt/{id}', 'CustomerController@payDebt')->name('customer.pay.debt');
    Route::delete('customer/delete/{id}', 'CustomerController@delete')->name('customer.delete');
    Route::get('get/receipt/{number}', 'CustomerController@getReceipt')->name('customers.get.receipt');

    //Expense
    Route::get('expenses', 'ExpenseController@index')->name('expenses');
    Route::post('expense/add', 'ExpenseController@add')->name('expense.add');
    Route::put('expense/update/{id}', 'ExpenseController@update')->name('expense.update');
    Route::delete('expense/delete/{id}', 'ExpenseController@delete')->name('expense.delete');

    //Extra Income
    Route::get('incomes', 'IncomeController@index')->name('incomes');
    Route::post('income/add', 'IncomeController@add')->name('income.add');
    Route::put('income/update/{id}', 'IncomeController@update')->name('income.update');
    Route::delete('income/delete/{id}', 'IncomeController@delete')->name('income.delete');

    //Inventory
    Route::get('inventories', 'InventoryController@index')->name('inventories');
    Route::get('inventory/add', 'InventoryController@showAddInventoryForm')->name('inventory.add');
    Route::post('inventory/add', 'InventoryController@add')->name('inventory.add');
    Route::post('inventory/confirm', 'InventoryController@confirm')->name('inventory.confirm');
    Route::post('inventory/cancel', 'InventoryController@cancel')->name('inventory.cancel');
    Route::put('inventory/{invID}/add/product', 'InventoryController@addProduct')->name('inventory.add.product');
    Route::get('delete/inventory/product/{id}', 'InventoryController@deleteProduct')->name('delete.collection.product');
    Route::get('inventory/view/{id}', 'InventoryController@view')->name('inventory.view');
    Route::put('inventory/update/description/{id}', 'InventoryController@updateDescription')->name('inventory.update.desc');
    Route::get('inventory/get/discounts/{id}', 'InventoryController@getDiscounts')->name('inventory.get.discounts');
    Route::put('inventory/update/{id}', 'InventoryController@update')->name('inventory.update');
    Route::put('inventory/add/to/stock/{id}', 'InventoryController@addToStock')->name('inventory.add.stock');
    Route::delete('inventory/delete/{id}', 'InventoryController@delete')->name('inventory.delete');

    //loss
    Route::get('loss/{id}', 'LossController@getLosses')->name('loss.get');
    Route::post('loss/add/{id}', 'LossController@addLoss')->name('loss.add');
    Route::post('loss/update/{id}', 'LossController@update')->name('loss.update');
    Route::post('loss/delete/{id}', 'LossController@delete')->name('loss.delete');

    //Sale
    Route::get('sale', 'SaleController@index')->name('sale');
    Route::get('sale/view', 'SaleController@viewSales')->name('sale.view');
    Route::post('sale/add', 'SaleController@add')->name('sale.add');
    Route::get('sale/delete/item/{id}', 'SaleController@delete')->name('sale.delete.item');
    Route::post('sale/confirm', 'SaleController@confirm')->name('sale.confirm');
    Route::get('sale/cancel', 'SaleController@cancel')->name('cancel.sale');

    //Reporting
    Route::get('dashboard', 'ReportController@dashboard')->name('dashboard');
    Route::get('report', 'ReportController@index')->name('report');
    Route::get('report/income/statement', 'ReportController@incomeStatement')->name('report.income.statement');
});


/*
 * Authentication
 * */
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
