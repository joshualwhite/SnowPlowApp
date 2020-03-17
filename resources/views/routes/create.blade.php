
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add a Route</h1>
        <a href="routes/" class="btn btn-primary">Go Back</a>
        {!! Form::open(['action' => 'RouteController@store', 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class'=> 'form-control', 'placeholder'=>'Name'])}}
        </div>

        <div class = "form-group">
            {{Form::label('user', 'User')}}
            {{Form::text('user', '', ['class'=> 'form-control', 'placeholder'=>'Who is assigned to this route?'])}}
        </div>

        <div class= "form-group">
            <h3>Add Customers to the Route</h3>
            @if(count($customers)>0)
                @foreach($customers as $customer)
                    <div class="d-flex flex-row align-items-baseline">
                        <p class="mr-2">{{$customer->name}}</p>
                        {{Form::checkbox('customers[]', $customer->id)}}
                    </div>
                @endforeach
            @endif
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        <hr>
    </div>
@endsection