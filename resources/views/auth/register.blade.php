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
                                    <input type="text" class="form-control" id="name" name="name" placeholder="First Name" value="{{ old('name') }}" required>
                                    <small id="namedesc" class="form-text text-muted">Your name is used only for emails and such.</small>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                    <small id="emaildesc" class="form-text text-muted">You must verify you email address after registration.</small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" value="" required>
                                    <small id="passdesc" class="form-text text-muted">Passwords must be at least 6 chatacters.</small>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" value="" required>
                                    <small id="confdesc" class="form-text text-muted">Retype your password.</small>
                                </div>
                                <div class="form-row my-4">
                                    <div class="col">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="tos" required>
                                            <label class="custom-control-label small text-muted" for="tos">I have read, understand, and agree to the <a href="#">Terms of Service</a> and the <a href="#">Account Sharing Policy</a> </label>
                                        </div>
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="tutorial" required>
                                            <label class="custom-control-label small text-muted" for="tutorial">I agree that after I create my account, I will complete the <strong>on-boarding tutorial</strong> and follow any and all instructions explained in the tutorial.</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="sharing" required>
                                            <label class="custom-control-label small text-muted" for="sharing">I understand that if I am suspected of sharing my account with anyone outside of my home, my account will be permanently banned and I will no longer have access to {{config('app.name')}}.</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                @if (Route::has('register'))
                                <a class="btn btn-link btn-block" href="{{route('register')}}">Sign in</a>
                                @endif
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
