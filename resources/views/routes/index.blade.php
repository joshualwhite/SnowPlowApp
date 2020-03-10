@extends('layouts.app')
@section('content')
<div class="container">
    @if(count($routes)>0)
        @foreach($routes as $route)
            <h3>{{$route->name}}</h3>
            @foreach($route->customers as $customer)
                <div class="lead dashboard-list">
                    <div class="pill pill-primary m-1 justify-start">{{$customer->status}}</div>
                    <div class="dashboard-customer justify-start">{{$customer->name}}, {{$customer->address}}</div>
                    <div class="d-b-align"><button class="btn btn-primary  m-1"><a href="/customers/{{$customer->id}}" class="text-light">DETAILS</a></button></div>
                </div>
            @endforeach
        @endforeach
    @else
        <p>No routes found</p>
    @endif
</div>
@endsection