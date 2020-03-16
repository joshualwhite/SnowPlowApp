@extends('layouts.app')

@section('content')
    <h1>Add a user</h1>
    {!! Form::open(['action' => 'UserController@store', 'method' => 'POST']) !!}
    <a href = "/users" class="btn btn-primary mb-2">Go Back</a>
    <div class = "form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class'=> 'form-control', 'placeholder'=>'Name'])}}
    </div>
    <div class = "form-group">
        {{Form::label('phone_number', 'Phone Number')}}
        {{Form::text('phone_number', '', ['class'=> 'form-control', 'placeholder'=>'(xxx) xxx-xxxx'])}}
    </div>

    <div class = "form-group">
        {{Form::label('email', 'email')}}
        {{Form::text('email', '', ['class'=> 'form-control', 'placeholder'=>'johndoe@domain.com'])}}
    </div>

    <div class = "form-group">
        {{Form::label('password', 'password')}}
        {{Form::text('password', '', ['class'=> 'form-control', 'placeholder'=>'password'])}}
    </div>

    <div class= "form-group">
        @if(count($routes)>0)
            <label for="route_select">Assign A Route</label><br>
            @foreach($routes as $route)
               {{Form::radio('route_select', $route->id)}}
               {{$route->name}}
            @endforeach 
        @endif
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <hr>
@endsection