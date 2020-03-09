<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Customer;

class CustomerController extends Controller
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
        $customers = Customer::orderBy('created_at', 'desc')->paginate(20);
        return view('customers.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
        $customer = Customer::find($id);  
        return view('customers.show')->with('customer', $customer);
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
        $customer->save();
        return redirect('/customers')->with('success', 'Post Updated');
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
        return redirect('/customers')->with('success', 'Customer Removed');
    }
}
