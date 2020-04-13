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
                                Sign into your account
                            </h1>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

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
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" value="" required>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheck1">Stay signed in</label>
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forgot password</a>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                @if (Route::has('register'))
                                <a class="btn btn-link btn-block" href="{{route('register')}}">Create an acount</a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
