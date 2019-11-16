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

Auth::routes(['register' => false]); /** @see \Illuminate\Routing\Router::auth */
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'DashboardController@index')->name('dashboard');
