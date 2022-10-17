@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<img src="/images/logo.png" alt="">
<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        

    <label for="password" >Password</label>
    <input id="password" type="password"  name="password" required autocomplete="current-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input class="form-check-input" style="display:none;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : 'checked' }}>

    <input type="submit" value="Login">
</form>

@endsection
