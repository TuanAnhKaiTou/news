<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware('guest:admin')->group(function () {
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@doLogin')->name('do-login');
});

Route::middleware('auth:admin')->group(function() {
    Route::get('/', function() {
        return redirect('news');
    });

    Route::get('logout', 'LogoutController@logout')->name('logout');

    Route::prefix('news')->group(function() {
        Route::name('news.')->group(function() {
            Route::get('/', 'NewsController@index')->name('list');
            Route::get('add-new', 'NewsController@create')->name('create');
            Route::post('add-new', 'NewsController@store')->name('store');
            Route::get('edit/{id}', 'NewsController@edit')->name('edit');
            Route::post('edit/{id}', 'NewsController@update')->name('update');
            Route::delete('delete', 'NewsController@destroy')->name('delete');
            Route::get('{id}', 'NewsController@show')->name('detail');
        });
    });

    Route::prefix('category')->group(function() {
        Route::name('category.')->group(function() {
            Route::get('/', 'CategoryController@index')->name('list');
            Route::get('add-new', 'CategoryController@create')->name('create');
            Route::post('add-new', 'CategoryController@store')->name('store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('edit/{id}', 'CategoryController@update')->name('update');
            Route::delete('delete', 'CategoryController@destroy')->name('delete');
        });
    });

    Route::prefix('source')->group(function() {
        Route::name('source.')->group(function() {
            Route::get('/', 'SourceController@index')->name('list');
            Route::get('add-new', 'SourceController@create')->name('create');
            Route::post('add-new', 'SourceController@store')->name('store');
            Route::get('edit/{id}', 'SourceController@edit')->name('edit');
            Route::post('edit/{id}', 'SourceController@update')->name('update');
            Route::delete('delete', 'SourceController@destroy')->name('delete');
        });
    });

    Route::prefix('user')->group(function() {
        Route::name('user.')->group(function() {
            Route::get('/', 'UserController@index')->name('list');
            Route::get('add-new', 'UserController@create')->name('create');
            Route::post('add-new', 'UserController@store')->name('store');
            Route::get('edit/{id}', 'UserController@edit')->name('edit');
            Route::post('edit/{id}', 'UserController@update')->name('update');
            Route::delete('delete', 'UserController@destroy')->name('delete');
        });
    });

    Route::prefix('admin')->group(function() {
        Route::name('admin.')->group(function() {
            Route::get('/', 'AdminController@index')->name('list');
            Route::get('add-new', 'AdminController@create')->name('create');
            Route::post('add-new', 'AdminController@store')->name('store');
            Route::get('edit/{id}', 'AdminController@edit')->name('edit');
            Route::post('edit/{id}', 'AdminController@update')->name('update');
            Route::delete('delete', 'AdminController@destroy')->name('delete');
            Route::post('change-pass', 'AdminController@changePass')->name('change');
            Route::get('{id}', 'AdminController@show')->name('show');
        });
    });

    Route::prefix('role')->group(function() {
        Route::name('role.')->group(function() {
            Route::get('/', 'RoleController@index')->name('list');
            Route::get('add-new', 'RoleController@create')->name('create');
            Route::post('add-new', 'RoleController@store')->name('store');
            Route::get('edit/{id}', 'RoleController@edit')->name('edit');
            Route::post('edit/{id}', 'RoleController@update')->name('update');
            Route::delete('delete', 'RoleController@destroy')->name('delete');
        });
    });
});
