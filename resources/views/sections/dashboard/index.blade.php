@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5>News</h5>
                    <hr>
                    No news
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Recent</h5>
                    <hr class="mb-0">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item px-0 py-2"><strong>Marc</strong> added <strong>The Blind Side</strong> 5 mins ago</li>
                        <li class="list-group-item px-0 py-2"><strong>Marc</strong> added <strong>The Blind Side</strong> 5 mins ago</li>
                        <li class="list-group-item px-0 py-2"><strong>Marc</strong> added <strong>The Blind Side</strong> 5 mins ago</li>
                        <li class="list-group-item px-0 py-2"><strong>Marc</strong> added <strong>The Blind Side</strong> 5 mins ago</li>
                        <li class="list-group-item px-0 py-2"><strong>Marc</strong> added <strong>The Blind Side</strong> <span class="text-muted">5 mins ago</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h5>Recent Movies <span class="small text-muted">Most recent movies added by your users</span></h5>
                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.movie')

@endsection


@push('scripts')

@endpush