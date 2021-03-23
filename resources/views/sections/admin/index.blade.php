@extends('layouts.app')

@section('nav-mini')
<div class="nav-scroller bg-white shadow-sm">
    <nav class="container nav navbar-dark nav-underline">
        <a class="nav-link" href="#">
            Movies <span class="badge badge-pill bg-light align-text-top">27</span>
        </a>
        <a class="nav-link" href="#">
            Reports <span class="badge badge-pill bg-danger text-white align-text-top">27</span>
        </a>
        <a class="nav-link" href="#">Users</a>
        <a class="nav-link" href="#">Settings</a>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5>Your System</h5>
                    <hr>
                    <div class="row">

                    </div>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Radarr Status:</td>
                                <td class="text-right"><span class="text-success">Online</span></td>
                            </tr>

                            <tr>
                                <td>Plex Status:</td>
                                <td class="text-right"><span class="text-success">Online</span></td>
                            </tr>

                            <tr>
                                <td>IP Address:</td>
                                <td class="text-right">{{ $_SERVER['REMOTE_ADDR'] }}</td>
                            </tr>

                            <tr>
                                <td>Users:</td>
                                <td class="text-right">4</td>
                            </tr>

                            <tr>
                                <td>Movies:</td>
                                <td class="text-right">4</td>
                            </tr>



                        </tbody>
                    </table>
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