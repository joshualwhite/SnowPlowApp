@extends('layouts.app')

@section('content')
    <a href = "/customers" class="btn btn-primary mb-2">Go Back</a>
    @if($customer)
        <h1>{{$customer->name}}</h1>
        <span><h3>Rating: {{$customer->rating}}</h3><h3>Status: {{$customer->status}}</h3></span>
        {!! Form::open(['action' => ['CustomerController@update', $customer->id], 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $customer->name, ['class'=> 'form-control', 'placeholder'=>'Name'])}}
        </div>
        <div class = "form-group">
            {{Form::label('phone_number', 'Phone Number')}}
            {{Form::text('phone_number', $customer->phone_number, ['class'=> 'form-control', 'placeholder'=>'(xxx) xxx-xxxx'])}}
        </div>
        <div class = "form-group">
            {{Form::label('address', 'Address')}}
            {{Form::text('address', $customer->address, ['class'=> 'form-control', 'placeholder'=>'Address'])}}
        </div>
        <div class = "form-group">
            {{Form::label('comments', 'Comments')}}
            {{Form::textArea('comments', $customer->comments, ['class'=> 'form-control', 'placeholder'=>'Initial Comments'])}}
        </div>
        <div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            
            {!! Form::open(['action' => ['CustomerController@destroy', $customer->id], 'method'=>'POST', 'class'=>'float-right']) !!}
                    {{  Form::hidden('_method', 'DELETE')  }}
                    {{  Form::submit('Delete Customer', ['class' => 'btn btn-danger'])  }}
            {!! Form::close() !!}
        </div>
        <hr>
    @else
        <p>Error Loading Customer Details</p>
    @endif
@endsection