@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-lg-6">
            <div class="card">
                <div class="card-body">
                    <p class="lead text-center font-weight-bold m-0">Settings</p>
                    <p class="small text-muted text-center">Edit your site settings</p>
                    <hr>
                    <form>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Display Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="staticEmail" value="{{$user->name}}">
                                <small id="emailHelp" class="form-text text-muted">The name that is displayed to other users on the site.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email Address:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="staticEmail" value="{{$user->email}}">
                                <small id="emailHelp" class="form-text text-muted">You can not change this.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Password:</label>
                            <div class="col-sm-8 mt-sm-2">
                                <button type="button" class="btn btn-primary btn-block btn- btn-sm">Change Password</button>
                            </div>
                        </div>

                        <hr>

                        <div class="alert alert-warning text-center" role="alert">
                            Email notification are currently not available yet.
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email Notifications:</label>
                            <div class="col-sm-8">
                                <div class="custom-control custom-checkbox mt-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">
                                        New Movies
                                        <small id="emailHelp" class="form-text text-muted">Get an email notification when users add new movies.</small>
                                    </label>
                                </div>
                                <div class="custom-control custom-checkbox mt-sm-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">
                                        Trending Movies
                                        <small id="emailHelp" class="form-text text-muted">Get a daily email with a list of trending movies that are not added.</small>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection