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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 



/**
 * Customers API Routes
 * All methods on CustomerController API
 * Returns Customer Resource
**/

// gets all customers
Route::get('customers', 'CustomerControllerAPI@index');
// gets a single customer by id
Route::get('customer/{id}', 'CustomerControllerAPI@show');
// creates a new customer
Route::post('customer', 'CustomerControllerAPI@store');
// updates an existing customer
Route::put('customer', 'CustomerControllerAPI@store');
// deletes a customer
Route::delete('customer/{id}', 'CustomerControllerAPI@destroy');


/**
 * Users API Routes
 * All methods on UserControllerAPI
 * Returns User Resource
**/
Route::get('usersAPI', 'UserControllerAPI@index');
Route::delete('usersAPI/{id}', 'UserControllerAPI@destroy');
Route::post('usersAPI', 'UserControllerAPI@store');



/**
 * (Snow Routes) API Routes (urls)
 * All methods on CustomerController API
 * Returns Routes Resource
**/

// gets all routes
Route::get('routes', 'RouteControllerAPI@index');
// gets a single route by id
Route::get('route/{id}', 'RouteControllerAPI@show');
// creates a new route
Route::post('route', 'RouteControllerAPI@store');
// updates an existing route
Route::put('route', 'RouteControllerAPI@store');
// deletes a route
Route::delete('route/{id}', 'RouteControllerAPI@destroy');
