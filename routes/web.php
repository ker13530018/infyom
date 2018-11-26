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
})->name('index');

Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@store')->name('login.store');
Route::post('/logout', 'LoginController@destroy')->name('login.destroy');

Route::middleware(['login'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // infoym route
    Route::resource('contents', 'ContentController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('userRoles', 'UserRolesController');
    // custom route and controller
    Route::get('/userRoles/{id}/assign', 'UserRolesController@assign')->name('userRoles.assign');
    Route::post('/userRoles/{id}/role', 'UserRolesController@role')->name('userRoles.role');

});
