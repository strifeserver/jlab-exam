<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/system', function (Request $request) {
    return $request->user();
});



Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthenticationController@login');
    // Route::post('admin/login', 'AuthenticationController@login');
    // Route::post('customer/login', 'AuthenticationController@login');

    Route::middleware('checkApiToken')->group(function () {
        Route::get('admin/profile', 'AuthenticationController@adminProfile');
        Route::get('customer/profile', 'AuthenticationController@customerProfile');
    });
});

Route::post('register', 'AccountsController@store');




Route::get('/config-check', function () {
    // Check auth guards
    $authGuards = config('auth.guards');
    dd($authGuards);

    // Check sanctum providers
    $sanctumProviders = config('sanctum.providers');
    dd($sanctumProviders);
});
