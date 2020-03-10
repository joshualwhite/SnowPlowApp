@extends('layouts.app')

@section('content')
    <h1>Add a Customer</h1>
    {!! Form::open(['action' => 'CustomerController@store', 'method' => 'POST']) !!}
    <div class = "form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class'=> 'form-control', 'placeholder'=>'Name'])}}
    </div>
    <div class = "form-group">
        {{Form::label('phone_number', 'Phone Number')}}
        {{Form::text('phone_number', '', ['class'=> 'form-control', 'placeholder'=>'(xxx) xxx-xxxx'])}}
    </div>
    <div class = "form-group">
        {{Form::label('address', 'Address')}}
        {{Form::text('address', '', ['class'=> 'form-control', 'placeholder'=>'Address'])}}
    </div>
    <div class = "form-group">
        {{Form::label('comments', 'Comments')}}
        {{Form::textArea('comments', '', ['class'=> 'form-control', 'placeholder'=>'Initial Comments'])}}
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