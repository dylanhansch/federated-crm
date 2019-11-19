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

Route::resource('/regions', 'RegionController');
Route::post('/regions/{region}/addAssignedUser', 'RegionController@addAssignedUser')->name('regions.addAssignedUser');
Route::delete('/regions/{region}/removeAssignedUser/{user}', 'RegionController@removeAssignedUser')->name('regions.removeAssignedUser');

Route::resource('/districts', 'DistrictController');
Route::post('/districts/{district}/addAssignedUser', 'DistrictController@addAssignedUser')->name('districts.addAssignedUser');
Route::delete('/districts/{district}/removeAssignedUser/{user}', 'DistrictController@removeAssignedUser')->name('districts.removeAssignedUser');

Route::resource('/territories', 'TerritoryController');
Route::post('/territories/{territory}/addAssignedUser', 'TerritoryController@addAssignedUser')->name('territories.addAssignedUser');
Route::delete('/territories/{territory}/removeAssignedUser/{user}', 'TerritoryController@removeAssignedUser')->name('territories.removeAssignedUser');
