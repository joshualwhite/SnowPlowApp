
@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="/routes" class="btn btn-primary">Go Back</a>
        <h1>{{$data['route']->name}}</h1>
        {!! Form::open(['action' => 'RouteController@store', 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('name', 'Route Name')}}
            {{Form::text('name', $data['route']->name, ['class'=> 'form-control', 'placeholder'=>'Name'])}}
        </div>
        <div class= "form-group">
            <div class="row">
                @if(count($data['customers'])>0)
                    <div class="col-sm-4">
                    <h3>Customers On Route</h3>
                    @foreach($data['customers'] as $customer)
                        <div class="d-flex flex-row align-items-baseline">
                            <p class="mr-2">{{$customer->name}}</p>
                            {{Form::checkbox('customers[]', $customer->id, true)}}
                        </div>
                    @endforeach
                    </div>
                @endif
                @if(count($data['unassigned'])>0)
                    <div class="col-sm-4">
                    <h3>Unassigned Customers</h3>
                    @foreach($data['unassigned'] as $customer)
                        <div class="d-flex flex-row align-items-baseline">
                            <p class="mr-2">{{$customer->name}}</p>
                            {{Form::checkbox('customers[]', $customer->id, false)}}
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            @if($data['route']->name != 'Unassigned')
                {!! Form::open(['action' => ['RouteController@destroy', $data['route']->id], 'method'=>'POST', 'class'=>'float-right']) !!}
                            {{  Form::hidden('_method', 'DELETE')  }}
                            {{  Form::submit('Delete Route', ['class' => 'btn btn-danger'])  }}
                {!! Form::close() !!}
            @endif
        </div>
        <hr>
    </div>
@endsection