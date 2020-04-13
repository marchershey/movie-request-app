@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-4">{{config('app.name')}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Installed Movies <span class="badge badge-primary align-text-top">97</span> </p>
                    <hr>
                    <p>test</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
