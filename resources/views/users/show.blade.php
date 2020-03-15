@extends('layouts.app')

@section('content')
    <a href = "/users" class="btn btn-primary mb-2">Go Back</a>
    @if($data['customer'])
        <h1>{{$data['customer']->name}}</h1>
        <h3>Rating: {{$data['customer']->rating}}</h3>
        <div class="pill pill-primary m-1">{{$data['customer']->status}}</div>

        {!! Form::open(['action' => ['CustomerController@update', $data['customer']->id], 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $data['customer']->name, ['class'=> 'form-control', 'placeholder'=>'Name'])}}
        </div>
        <div class = "form-group">
            {{Form::label('phone_number', 'Phone Number')}}
            {{Form::text('phone_number', $data['customer']->phone_number, ['class'=> 'form-control', 'placeholder'=>'(xxx) xxx-xxxx'])}}
        </div>
        <div class = "form-group">
            {{Form::label('address', 'Address')}}
            {{Form::text('address', $data['customer']->address, ['class'=> 'form-control', 'placeholder'=>'Address'])}}
        </div>
        <div class = "form-group">
            {{Form::label('comments', 'Comments')}}
            {{Form::textArea('comments', $data['customer']->comments, ['class'=> 'form-control', 'placeholder'=>'Initial Comments'])}}
        </div>
        <div class= "form-group">
            @if(count($data['routes'])>0)
                <label for="route_select">Assign A Route</label><br>
                @foreach($data['routes'] as $route)
                    @if($route->id == $data['customer']->route_id)
                        {{Form::radio('route_select', $route->id, true)}}
                    @else
                        {{Form::radio('route_select', $route->id)}}
                    @endif
                   {{$route->name}}
                @endforeach 
            @endif
        </div>
        <div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            
            {!! Form::open(['action' => ['CustomerController@destroy', $data['customer']->id], 'method'=>'POST', 'class'=>'float-right']) !!}
                    {{  Form::hidden('_method', 'DELETE')  }}
                    {{  Form::submit('Delete Customer', ['class' => 'btn btn-danger'])  }}
            {!! Form::close() !!}
        </div>
        <hr>
    @else
        <p>Error Loading Customer Details</p>
    @endif
@endsection