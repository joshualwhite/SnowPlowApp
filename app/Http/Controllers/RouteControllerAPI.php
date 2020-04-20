<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Route as RouteResource;
use App\Http\Controllers\DB;
use App\Route;
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
        foreach($routes as $route)
            $route->customers = Customer::where('route_id', $route->id)->orderBy('route_position', 'asc')->select('phone_number', 'status', 'name', 'address', 'id', 'route_position', 'route_id', 'address', 'comments')->get();
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
    public function routeStatus(){
        $routes = Route::where('id', '!=' , 1)->get();
        $total = 0;
        foreach($routes as $route){
            $customers = Customer::where('route_id', $route->id)->select('status')->get();
            $total = 0;
            $done = 0;
            foreach($customers as $customer){
                if ($customer->status == 2 || $customer->status == 3 || $customer->status == 4){
                    $done += 1;
                }
                $total += 1; 
            }
            $route->total = $total;
            $route->done = $done;
        }
        return RouteResource::collection($routes);
    }

    public function sort_bottom() {
        Route::where('sort_by', '!=', 1)->update(array('sort_by' => 1));
        return "Routes Starting From the Bottom";
    }

    public function sort_top() {
        $routes = Route::where('sort_by', '!=', 0)->update(array('sort_by' => 0));
        return "Routes Starting From the Top";
    }

    public function reset_routes(){
        Customer::where('status', '!=', 0)->update(array('status' => 0));
        return "Routes Reset Successfully!";
    }
}

