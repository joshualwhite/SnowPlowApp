<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Route as RouteResource;
use App\Route;
use Illuminate\Support\Facades\DB;
use App\Customer;

class RouteControllerAPI extends Controller
{
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::all();

        foreach($routes as $route){
           $route->customers = Customer::where('route_id', $route->id)->select('name', 'address', 'id', 'route_position')->get();
        }
        return RouteResource::collection($routes);
    }
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simple()
    {
        $routes = Route::select('id', 'name')->get();
        return RouteResource::collection($routes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = $request->isMethod('put') ? Route::findOrFail($request->id) : new Route;
        $route->name = $request->input('name');
        // TODO Get User for Route
        $route->user = 0;
        $route->save();
        $id = $route->id;
        // Deal With Customer Assignments
        $customers = $request->input('customers');
        foreach($customers as $customer){
           // return $customer;
            if($customer['name'] != ''){
                $edit_customer = Customer::findOrFail($customer['id']);
                $edit_customer->route_id = $id;
                $edit_customer->route_position = $customer['route_position'];
                $edit_customer->save();
            }
        }
        $customers = $request->input('unassigned');
        foreach($customers as $customer){
            $edit_customer = Customer::findOrFail($customer['id']);
            $edit_customer->route_id = 1;
            $edit_customer->route_position = 0;
            $edit_customer->save();     
        }
        if($route->save())
            return new RouteResource($route);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::findOrFail($id);
        return new RouteResource($route);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1){
            return "Cannot Delete Default Route";
        }
        else {
            $route = Route::findOrFail($id);
            if($route->delete())
                return new RouteResource($route);
        }
    }

    public function reset_routes() {
        DB::table('customers')->update(['status' => 0]);
    }

    public function sort_by() {
        if(Route::select('sort_by')->first()->sort_by){
            DB::table('routes')->update(['sort_by' => 0]);
            $status = 0;
        }
        else {
            DB::table('routes')->update(['sort_by' => 1]);
            $status = 1;
        }
        return $status; 
    }
}

