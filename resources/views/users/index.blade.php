@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <span>
    <a href="users/create" class="btn btn-primary mb-2">Add New User</a>
    <h3>Filter / Search TODO</h3>
    </span>
    @if(count($user) > 0)
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Assigned Route</th>
                <th></th>
            </tr>
            @foreach($user as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>
                    <td>{{$user->route_id}}</td>
                    <td><a href="/">Details</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No Users</p>
    @endif
@endsection