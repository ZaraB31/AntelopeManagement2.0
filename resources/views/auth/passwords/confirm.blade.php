@extends('layouts.auth')

@section('content')

<img src="/images/logo.png" alt="">

<h1>Please confirm your password before continuing.</h1>

<form method="POST" action="{{ route('password.confirm') }}">
    @include('includes.error') 

    <label for="password">{{ __('Password') }}</label>

    <input id="password" type="password" name="password" required autocomplete="current-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input type="submit" value="Confirm Password">

    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
</form>
@endsection
