<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware('auth')->group(function (){
    Route::get('home',function (){
        return view('layout.app');
    });

    //Configuration
    Route::get('configure','ConfigurationController@index')->name('configure');
    Route::post('configure/sell/method','ConfigurationController@changeSellMethod')->name('sellMethod');
    Route::post('add/expense/type','ConfigurationController@addExpenseType')->name('addExpenseType');
    Route::put('update/expense/type/{id}','ConfigurationController@updateExpenseType')->name('updateExpenseType');
    Route::delete('delete/expense/type/{id}','ConfigurationController@deleteExpenseType')->name('deleteExpenseType');
    Route::get('add/role','ConfigurationController@viewAddRoleForm')->name('addRole');
    Route::post('add/role','ConfigurationController@addRole')->name('addRole');
    Route::get('edit/role/{id}','ConfigurationController@editRole')->name('editRole');
    Route::put('edit/role/{id}','ConfigurationController@updateRole')->name('editRole');
    Route::delete('delete/role/{id}','ConfigurationController@deleteRole')->name('deleteRole');

    //User
    Route::get('users','UserController@index')->name('users');
    Route::post('user/add','UserController@add')->name('user.add');
    Route::put('user/update/{id}','UserController@update')->name('user.update');
    Route::put('user/reset/{id}','UserController@reset')->name('user.reset');
    Route::put('user/change/password','UserController@changePassword')->name('user.change.password');
    Route::delete('user/delete/{id}','UserController@delete')->name('user.delete');
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
