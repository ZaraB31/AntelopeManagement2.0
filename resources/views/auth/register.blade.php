@extends('layouts.auth')

@section('content')
<img src="/images/logo.png" alt="">

<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">Name</label>
    <input id="name" type="text"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required autocomplete="new-password">

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">

    <input type="submit" value="Register">
</form>
@endsection
