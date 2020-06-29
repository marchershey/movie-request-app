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
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                @if (session('status'))
                                <div class="alert alert-success text-center small" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" disabled>
                                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password" autofocus>

                                    @error('password')
                                    <span class="invalid-feedback text-center" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control text-center" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Reset Password') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection