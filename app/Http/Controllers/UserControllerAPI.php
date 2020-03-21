<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Route;
Use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        
        $user = $request->isMethod('put') ? User::findOrFail($request->id) : new User;

        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        
        $password = ($request->isMethod('put')) ? "" : $request->input('password');
        $user->password = Hash::make($password);

        $user->admin = ($request->input('admin') == 0) ? 0 : 1;


        if($user->save())
            return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function current()
    {
        print(Auth::id());
        $user = User::findOrFail(Auth::id())->first();
        return new UserResource($user); 
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
