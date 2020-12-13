<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('not-login', function() {
    return response()->json([
        'status'    => 'error',
        'msg'       => 'You not login yet'
    ], 401);
});

Route::post('sign-up', 'API\UserAPI@signUp');

Route::post('login', 'API\UserAPI@login');

Route::middleware('auth.api:api')->group(function() {
    Route::get('logout', 'API\UserAPI@logout');

    Route::prefix('user')->group(function() {
        Route::get('', 'API\UserAPI@show');
    });

    Route::prefix('category')->group(function() {
        Route::get('', 'API\CategoryAPI@getList');
    });

    Route::prefix('news')->group(function() {
        Route::get('', 'API\NewsAPI@getList');
        Route::get('category', 'API\NewsAPI@getListByCategory');
    });
});
