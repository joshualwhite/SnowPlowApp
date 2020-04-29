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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('customers/index', 'PagesController@index');

Route::get('/customer/{id}', 'PagesController@customer');
Route::get('/route/{id}', 'PagesController@route');
Route::get('/customers', 'PagesController@customers')->name('customers')->middleware('is_admin');
Route::get('/routes', 'PagesController@routes')->name('routes')->middleware('is_admin');
Route::get('/users', 'PagesController@users')->name('users')->middleware('is_admin');

Route::get('/home', 'HomeController@index')->name('home')->middleware('is_admin');

