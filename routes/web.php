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

Route::get('customers/index', 'PagesController@index');
Auth::routes();

// Home Controller is the dashboard
Route::get('/home', 'HomeController@index')->name('home');

//Route for Customers
Route::resource('customers', 'CustomerController')->middleware('is_admin');
Route::resource('routes', 'RouteController')->middleware('is_admin');
Route::resource('users', 'UserController')->middleware('is_admin');

//Sort by button
Route::post('/reset', 'RouteController@reset')->middleware('is_admin');
Route::post('/sortBy', 'RouteController@sortBy')->middleware('is_admin');

Route::get('/home', 'HomeController@index')->name('home')->middleware('is_admin');
Route::delete('customers/{id}', 'CustomerControllerAPI@destroy')->middleware('is_admin');
