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

Route::group(['middleware' => 'sentinel'], function () {

    Route::group(['middleware' => 'admin'], function () {

        Route::get('/', function () {
            return redirect('/users/list');
        });

        Route::get('debtors/list', 'DebtorController@index')->name('debtor-list');
        Route::get('debtors/data', 'DebtorController@listData')->name('debtors.data');
        Route::post('debtor/export', 'DebtorController@export')->name('debtors.export');
    });

    Route::post('debtors/search', 'DebtorController@searchPost')->name('debtor-search');
    Route::get('debtors/search', 'DebtorController@searchView')->name('debtor-search-view');
});

Route::resource('login', 'SentinelAuthController');
Route::get('/password/reset', 'SentinelAuthController@resetView')->name('pwd-reset');
Route::post('/password/reset', 'SentinelAuthController@resetPasswordView')->name('pwd-reset-view');
Route::get('register', 'SentinelAuthController@registerView')->name('register');
Route::post('register', 'SentinelAuthController@register')->name('register');
Route::get('logout', 'SentinelAuthController@logout')->name('logout');
