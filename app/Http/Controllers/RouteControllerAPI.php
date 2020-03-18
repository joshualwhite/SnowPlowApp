<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Route as RouteResource;
use App\Route;

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
        $route = $request->isMethod('put') ? Route::findOrFail($request->id) : new Route;

        $route->name = $request->input('name');
        $route->user = 0;
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
}
