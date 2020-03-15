<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;
use App\Customer;

class RouteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::all();
        return view('routes.index')->with('routes', $routes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 1 is the 'Unassigned' route
        $customers = Customer::where('route_id', 1)->get();
        return view('routes.create')->with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $route = new Route;
        $route->name = $request->input('name');
        $route->save();
        //$customers is an array of id's
        $customers = $request->input('customers');
        
        //$route = Route::orderBy('created_at', 'desc')->get();
        if($customers){
            foreach($customers as $id){
                $_customer = Customer::find($id);
                $_customer->route_id = $route->id;
                $_customer->save();
            }
        }

        $routes = Route::all();

        //return $route->id;

        return view('routes.index')->with('routes', $routes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::find($id);
        

        $customers = Customer::where('route_id', $route->id)->get();
        $unassigned = Customer::where('route_id', 1)->get();

        $data = [
            'route'=> $route,
            'customers'=> $customers,
            'unassigned' => $unassigned
        ];
        //return $data;
        return view('routes.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $route = Route::find($id);
        $route->name = $request->input('name');
        $route->save();
        //$customers is an array of id's
        $customers = $request->input('customers');
        
        //$route = Route::orderBy('created_at', 'desc')->get();
        if($customers){
            foreach($customers as $id){
                $_customer = Customer::find($id);
                $_customer->route_id = $route->id;
                $_customer->save();
            }
        }
       
        //  TODO remove unselected customers

        $routes = Route::all();
        

        //return $route->id;

        return view('routes.index')->with('routes', $routes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::find($id);

        if($route->name == "Unassigned"){
            return redirect('routes/'.$route->id)->with('error', 'Cannot Delete Default Route.');
        }

        /* Reassign Customers to default route */
        $customers =  Customer::where('route_id', $id)->get();
        foreach($customers as $customer){
            $customer->route_id = 1;
            $customer->route_position = 0;
            $customer->save();
        }   

        $route->delete();
        return redirect('/routes')->with('success', 'Route Removed');
    }

    public function reset(){
        Route::all()->status = "Not done";
        return redirect('/routes')->with('success', 'Routes Reset');
    }

    public function sortBy(){
        $result = (Route::get()[0]->sort_by === 1) ? 0 : 1;
        $statement = ($result == 1) ? 'Starting From Bottom' : 'Starting From Top';


        $routes = Route::all();
        foreach($routes as $route){
            $route->sort_by = $result;
            $route->save();
        }
        return $result;
        return redirect('/routes')->with($statement, 'Routes Reset');

    }
}
