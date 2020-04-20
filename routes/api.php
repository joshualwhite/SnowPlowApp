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

Route::get('customers', 'CustomerControllerAPI@index');
Route::get('customer/{id}', 'CustomerControllerAPI@show');
Route::get('customers/route/{id}', 'CustomerControllerAPI@customers');
Route::post('customer', 'CustomerControllerAPI@store');
Route::put('customer', 'CustomerControllerAPI@store');
Route::delete('customer/{id}', 'CustomerControllerAPI@destroy');

/**
 * Users API Routes
 * All methods on UserControllerAPI
 * Returns User Resource
**/
Route::get('users', 'UserControllerAPI@index');
Route::delete('users/{id}', 'UserControllerAPI@destroy');
Route::post('users', 'UserControllerAPI@store');
Route::put('users', 'UserControllerAPI@store');
Route::get('users/current', 'UserControllerAPI@current');

/**
 * (Snow Routes) API Routes (urls)
 * All methods on CustomerController API
 * Returns Routes Resource
**/

// gets all routes
Route::get('routes', 'RouteControllerAPI@index');
// get all routes - Just name and ID, used on customers page to select route
Route::get('routes/simple', 'RouteControllerAPI@simple');
// gets a single route by id
Route::get('route/{id}', 'RouteControllerAPI@show');
// creates a new route
Route::post('route', 'RouteControllerAPI@store');
// updates an existing route
Route::put('route', 'RouteControllerAPI@store');
// deletes a route
Route::delete('route/{id}', 'RouteControllerAPI@destroy');
// Sets all customer status to 0 or "Not Done"
Route::put('routes/reset', 'RouteControllerAPI@reset_routes');
// Sets sort_by to the 0 or 1
Route::put('routes/sort-top', 'RouteControllerAPI@sort_top');
Route::put('routes/sort-bottom', 'RouteControllerAPI@sort_bottom');
//get routes status
Route::get('route_status', 'RouteControllerAPI@routeStatus');