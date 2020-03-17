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
        $customers = Customer::select('name', 'address', 'id', 'route_id')->orderBy('created_at', 'desc')->paginate(20);
        
        // Replaces "route_id" route->name to be user friendly
        foreach($customers as $customer) {
            $route = Route::find($customer->route_id);
            $customer->route_id = $route->name;
        }
        
        return CustomerResource::collection($customers);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::all();
        return view('customers.create')->with('routes', $routes);
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
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $customer = new Customer;

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        $customer->status = "Not Done";
        if($request->input('comments'))
            $customer->comments = $request->input('comments');
        else $customer->comments = "";
        $customer->rating = 0;
        $customer->route_id = $request->input('route_select');
        $customer->save();

        return redirect('/customers')->with('success', 'Customer Added');
    }

    /**
     * Display the specified resource.
     * customer.show is where edits and deletes take place
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routes = Route::all();
        $customer = Customer::find($id);

        $data = [
            'routes'=> $routes,
            'customer'=> $customer
        ];
        return view('customers.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Nothing
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
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        $customer = Customer::find($id);

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        $customer->status = "Not Done";
        
        if($request->input('comments'))
            $customer->comments = $request->input('comments');
        else $customer->comments = "";
        
        if($customer->rating > 0)
            $customer->rating = $customer->rating;
        else $customer->rating = 0;
        
        if($request->input('route_select') != $customer->route_id)
            $customer->route_id = $request->input('route_select');
        
        $customer->save();
        return redirect('/customers')->with('success', 'Customer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
    }
}
