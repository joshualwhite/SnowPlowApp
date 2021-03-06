<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Customer;
Use App\Route;
Use App\Http\Resources\Customer as CustomerResource;


class CustomerControllerAPI extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->paginate(20);
        // Replaces "route_id" route->name to be user friendly
        foreach($customers as $customer) {
            $route = Route::find($customer->route_id);
            $customer->route_id = $route->name;
        }
        
        return CustomerResource::collection($customers);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = $request->isMethod('put') ? Customer::findOrFail($request->customer_id) : new Customer;

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        if ($request->input('status'))
            $customer->status = $request->input('status');
        else $customer->status = 0;
        if($request->input('comments'))
            $customer->comments = $request->input('comments');
        else $customer->comments = "";

        $customer->rating = ($customer->rating > 0) ? $customer->rating : 0;
        $customer->route_id = $request->input('route_id'); 
        if($customer->save())
            return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     * customer.show is where edits and deletes take place
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return new CustomerResource($customer);
    }

    public function customers($id)
    {
        $route = Route::find(1);
        $route = $route->sort_by;
        error_log($route);

        if($route == 1){
            $i = 0;
            $customers = Customer::where('route_id', $id)->orderBy('route_position', 'desc')->select('status', 'name','id', 'route_position', 'route_id')->get();
            foreach($customers as $customer)
                $customer->route_position = $i++;
        }
        else
            $customers = Customer::where('route_id', $id)->orderBy('route_position', 'asc')->select('status', 'name','id', 'route_position', 'route_id')->get();
        return CustomerResource::collection($customers);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        if($customer->delete())
            return new CustomerResource($customer);
    }
}
