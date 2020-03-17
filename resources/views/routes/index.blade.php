@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex flex-row">
        <a href="routes/create" class="btn btn-primary p-2">Create New Route</a>
        {!! Form::open(['action' => ['RouteController@reset' ], 'method' => 'POST']) !!}
            {{Form::submit('Reset Route Status', ['class'=>'btn btn-danger p-2 ml-2'])}}
        {!! Form::close() !!}
        {!! Form::open(['action' => ['RouteController@sortBy' ], 'method' => 'POST']) !!}
            {{Form::submit('Start From '. (($routes[0]->sort_by == 1) ? 'Bottom' : 'Top' ), ['class'=>'btn btn-secondary p-2 ml-2'])}}
        {!! Form::close() !!}
    </div>
    @if(count($routes)>0)
    <hr>
        @foreach($routes as $route)
            <h3 class="mt-4">{{$route->name}}</h3>
            <a class="mr-3" href="EMPLOYEE ID">{{$route->user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
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