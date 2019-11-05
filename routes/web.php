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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*custom logout rout get request*/
Route::get('/logout', 'Auth\LoginController@logout', function () {
    return abort(404);
})->name('logout');

/*namespace rout for admin*/
Route::group([
   // 'name' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'admin',
    'middleware' => ['auth','menus','isAdmin'],
    ], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController',['except' => []]);
    
});
