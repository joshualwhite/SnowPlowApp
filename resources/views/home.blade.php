@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Admin Dashboard</div>

                <div class="card-body">
                    <a href="/customers" class="btn btn-primary">Manage Customers</a>
                    <a href="/users" class="btn btn-primary">Manage Users</a>
                    <a href="/routes" class="btn btn-primary">Manage Routes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
