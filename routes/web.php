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


use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {
    /** home page */
    Route::get('/', 'WebController@home')->name('home');

    /** contact page */
    Route::get('/contact', 'WebController@contact')->name('contact');

    /** rental page */
    Route::get('/quero-alugar', 'WebController@rent')->name('rent');

    /** purchase page */
    Route::get('/quero-comprar', 'WebController@buy')->name('buy');

    /** filter page */
    Route::get('/filtro', 'WebController@filter')->name('filter');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    /** login  form */
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    /** protected routes */
    Route::group(['middleware' => ['auth']], function () {

        /** Dashborad Home */
        Route::get('home', 'AuthController@home')->name('home');

        /** Users */
        Route::get('users/team', 'UserController@team')->name('users.team');
        Route::resource('users', 'UserController');

        /** Companies */
        Route::resource('companies', 'CompanyController');

        /** Property */
        Route::post('properties/image-set-cover', 'PropertyController@imageSetCover')->name('properties.imagesSetCover');
        Route::delete('properties/image-remove', 'PropertyController@imageRemove')->name('properties.imagesRemove');
        Route::resource('properties', 'PropertyController');

        /** Contracts */
        Route::post('contracts/get-data-owner', 'ContractController@getDataOwner')->name('contracts.getDataOwner');
        Route::post('contracts/get-data-acquirer', 'ContractController@getDataAcquirer')->name('contracts.getDataAcquirer');
        Route::post('contracts/get-data-property', 'ContractController@getDataProprety')->name('contracts.getDataProprety');
        Route::get('contracts/remover/{id}', 'ContractController@remover')->name('contracts.remover');
        Route::resource('contracts', 'ContractController');
    });

    /** logout */
    Route::get('logout', 'AuthController@logout')->name('logout');
});


