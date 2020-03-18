<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Route;
Use App\Http\Resources\User as UserResource;

class UserControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $users = User::orderBy('created_at', 'desc')->paginate(20);
            foreach($users as $user) {
                //$route = Route::find($user->route_id);
            }
    
            return UserResource::collection($users);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $routes = Route::all();
        return view('users.create')->with('routes', $routes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ]);*/
        $user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;
        $edit = $request->isMethod('put') ? TRUE : FALSE;
        if ($edit == '0'){
            $user->name = $request->input('name');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
        }
        else{
            $user->name = $request->input('name');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
        }
        if($user->save())
            return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete())
            return new UserResource($user);
    }
}
