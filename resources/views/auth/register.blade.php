@extends('layouts.auth')

@section('content')
<img src="/images/logo.png" alt="">

<form method="POST" action="{{ route('register') }}">
    @csrf  
    @include('includes.error')
    
    <label for="name">Name</label>
    <input id="name" type="text"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

    <label for="email">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required autocomplete="new-password">

    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">

    <input type="submit" value="Register">
</form>
@endsection
