@extends('layouts.auth')

@section('content')
<img src="/images/logo.png" alt="">

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @include('includes.error') 

    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input type="submit" value="Send Password Reset Link">

</form>
@endsection
