@extends('layouts.app')

@section('content')
    <a href = "/users" class="btn btn-primary mb-2">Go Back</a>
    @if($data['user'])
        <h1>{{$data['user']->name}}</h1>
        <h3>Rating: {{$data['user']->rating}}</h3>
        <div class="pill pill-primary m-1">{{$data['user']->name}}</div>

        {!! Form::open(['action' => ['userController@update', $data['user']->id], 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $data['user']->name, ['class'=> 'form-control', 'placeholder'=>'Name'])}}
        </div>
        <div class = "form-group">
            {{Form::label('phone_number', 'Phone Number')}}
            {{Form::text('phone_number', $data['user']->phone_number, ['class'=> 'form-control', 'placeholder'=>'(xxx) xxx-xxxx'])}}
        </div>
        <div class= "form-group">
            @if(count($data['routes'])>0)
                <label for="route_select">Assign A Route</label><br>
                @foreach($data['routes'] as $route)
                    @if($route->id == $data['user']->route_id)
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
            
            {!! Form::open(['action' => ['userController@destroy', $data['user']->id], 'method'=>'POST', 'class'=>'float-right']) !!}
                    {{  Form::hidden('_method', 'DELETE')  }}
                    {{  Form::submit('Delete user', ['class' => 'btn btn-danger'])  }}
            {!! Form::close() !!}
        </div>
        <hr>
    @else
        <p>Error Loading user Details</p>
    @endif
@endsection