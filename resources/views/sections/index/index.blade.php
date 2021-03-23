@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-lg-8">
            <div class="row">
                <div class="col text-center">
                    <h1>Welcome to {{ config('app.name') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.movie')

@endsection


@push('scripts')

@endpush