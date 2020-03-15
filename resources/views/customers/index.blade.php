@extends('layouts.app')

@section('content')
    <h1>Customers</h1>
    <span>
    <a href="customers/create" class="btn btn-primary mb-2">Add New Customer</a>
    <h3>Filter / Search TODO</h3>
    </span>
    @if(count($customers) > 0)
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Assigned Route</th>
                <th></th>
            </tr>
            @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->phone_number}}</td>
                    <td>{{$customer->route_id}}</td>
                    <td><a href="/customers/{{$customer->id}}">Details</a></td>
                </tr>
            @endforeach
        </table>
        {{$customers->links()}}
    @else
        <p>You don't have any customers?!</p>
    @endif
@endsection