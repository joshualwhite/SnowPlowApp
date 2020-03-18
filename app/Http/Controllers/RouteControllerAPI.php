<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Customer;
Use App\Route;
Use App\Http\Resources\Route as RouteResource;


class RouteControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $routes = Route::all();
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
        $route = new Route;
        $route->name = $request->input('name');
        $route->user = $request->input('user', '1');        
        if($route->save())
            return new RouteResource($route);
    }

    /**
     * Display the specified resource.
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
        $route = Route::findOrFail($id);
        if($route->delete())
            return new RouteResource($route);
    }
}
