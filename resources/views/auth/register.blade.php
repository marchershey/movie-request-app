@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h1 class="h4 text-muted text-center">
                                Create a new account
                            </h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                @error('name')
                                <div class="alert alert-danger small text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror

                                @error('email')
                                <div class="alert alert-danger small text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror

                                @error('password')
                                <div class="alert alert-danger small text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="form-group">
                                    <input type="text" class="form-control text-center" id="name" name="name" placeholder="First Name" value="{{ old('name') }}" required>
                                    <small id="namedesc" class="form-text text-muted text-center">Your name is used only for emails and such.</small>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control text-center" id="email" name="email" placeholder="Plex Email Address" value="{{ old('email') }}" required>
                                    <small id="emaildesc" class="form-text text-muted text-center">This must be the email address you used for Plex.</small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control text-center" name="password" placeholder="Password" value="" required>
                                    <small id="passdesc" class="form-text text-muted text-center">Passwords must be at least 6 chatacters.</small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control text-center" name="password_confirmation" placeholder="Confirm Password" value="" required>
                                    <small id="confdesc" class="form-text text-muted text-center">Retype your password.</small>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                <hr>

                                <a class="btn btn-link btn-block" href="{{route('login')}}">I already have an account</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- <hr>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div> --}}
@endsection