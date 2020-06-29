@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h1 class="h4 text-muted text-center">
                                Reset Password
                            </h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                @if (session('status'))
                                <div class="alert alert-success text-center small" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <input type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                <hr>
                                <a class="btn btn-link btn-block" href="{{route('login')}}">Go back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection