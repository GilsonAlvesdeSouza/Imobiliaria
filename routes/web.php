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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    /** Formulário de login */
    Route::get('/', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login')->name('login.do');

    /** Rotas protegidas */
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
        Route::resource('contracts', 'ContractController');
    });

    /** logout */
    Route::get('logout', 'AuthController@logout')->name('logout');
});
