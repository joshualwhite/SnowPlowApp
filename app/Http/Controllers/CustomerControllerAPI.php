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
        $customer->status = $request->input('status');
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
