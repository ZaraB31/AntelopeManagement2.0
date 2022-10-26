@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<img src="/images/logo.png" alt="">
<form method="POST" action="{{ route('login') }}">
    @csrf  @include('includes.error')

    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 

    <label for="password" >Password</label>
    <input id="password" type="password"  name="password" required autocomplete="current-password">

    <input class="form-check-input" style="display:none;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : 'checked' }}>

    <input type="submit" value="Login">
</form>

@endsection
