@extends('layouts.app')
@section('content')
<div class="container">
    @if(count($routes)>0)
    <a href="routes/create" class="btn btn-primary">Create New Route</a>
    <a href="routes" class="btn btn-danger">Reset From Top</a>
    <a href="routes" class="btn btn-danger">Reset From Bottom</a>

    <hr>
         @foreach($routes as $route)
            <h3 class="mt-4">{{$route->name}}</h3>
            <h5> Assigned Employees </h4>
            <a class="mr-3" href="EMPLOYEE ID">Employee 1</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
            <a class="btn btn-success" href="/routes/{{$route->id}}">Edit Route</a>
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Customers
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if(count($route->customers) > 0)
                        @foreach($route->customers as $customer)
                            <a class="dropdown-item" href="/customers/{{$customer->id}}">{{$customer->name}}, {{$customer->address}}</a>            
                        @endforeach
                    @else
                        <a class="dropdown-item">No Customers</a>
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
    @else
        <p>No routes found</p>
    @endif
</div>
@endsection