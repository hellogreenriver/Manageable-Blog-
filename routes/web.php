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
        
Route::get('/list{any}', function () {
    return view('index');
})->where('any', '.*');

Route::get('/login_for_system_admin_only', function () {
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/login_for_system_admin_only/{any}', function () {
        return view('login');
    })->where('any', '.*');
  });