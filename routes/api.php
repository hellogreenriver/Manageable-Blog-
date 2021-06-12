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

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/user',function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', 'App\Http\Controllers\LoginController@logout');
    Route::post('/create', 'App\Http\Controllers\CreateController@create' );
});

Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::get('/elements', 'App\Http\Controllers\ElementsController@index');
Route::get('/find', 'App\Http\Controllers\ElementsController@find');