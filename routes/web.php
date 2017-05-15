<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    //return view('welcome');
    //return view('greenshoe.index');


    return view('greenshoe.debtors.list');
});

Route::group(['middleware' => 'sentinel'], function () {

    Route::group(['middleware' => 'admin'], function () {

        Route::get('debtors/list', 'DebtorController@index')->name('debtor-list');
        Route::post('register', 'SentinelAuthController@register')->name('register');
        Route::get('debtors/data', 'DebtorController@listData')->name('debtors.data');
        Route::post('debtor/export', 'DebtorController@export')->name('debtors.export');
        Route::get('/users/list', 'SentinelAuthController@listUsers')->name('users-list');
    });

    Route::post('debtors/search', 'DebtorController@searchPost')->name('debtor-search');
    Route::get('debtors/search', 'DebtorController@searchView')->name('debtor-search-view');
});

Route::resource('login', 'SentinelAuthController');
Route::get('logout', 'SentinelAuthController@logout');
