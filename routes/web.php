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

Route::get('/', function () {
    return view('welcome');
});


// Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UsersController');

Route::resource('roles', 'RolesController');

Route::resource('userRoles', 'UserRolesController');

Route::get('/userRoles/{id}/assign', 'UserRolesController@assign')->name('userRoles.assign');
Route::post('/userRoles/{id}/role', 'UserRolesController@role')->name('userRoles.role');

Route::resource('contents', 'ContentController');
