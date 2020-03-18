<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Http\Resources\Route as RouteResource;
use App\Route;
=======
Use App\Customer;
Use App\Route;
Use App\Http\Resources\Route as RouteResource;

>>>>>>> master

class RouteControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
=======
    
>>>>>>> master
    public function index()
    {
        $routes = Route::all();
        return RouteResource::collection($routes);
<<<<<<< HEAD
=======
        
>>>>>>> master
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $route = $request->isMethod('put') ? Route::findOrFail($request->id) : new Route;

        $route->name = $request->input('name');
        $route->user = 0;
        if($route->save())
            return new RouteResource($route);    
=======
        $route = new Route;
        $route->name = $request->input('name');
        $route->user = $request->input('user', '1');        
        if($route->save())
            return new RouteResource($route);
>>>>>>> master
    }

    /**
     * Display the specified resource.
<<<<<<< HEAD
     *
=======
>>>>>>> master
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::findOrFail($id);
        return new RouteResource($route);
    }
<<<<<<< HEAD
=======

>>>>>>> master
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        if($id == 1){
            return "Cannot Delete Default Route";
        }
        else {
            $route = Route::findOrFail($id);
            if($route->delete())
                return new RouteResource($route);
        }
=======
        $route = Route::findOrFail($id);
        if($route->delete())
            return new RouteResource($route);
>>>>>>> master
    }
}
