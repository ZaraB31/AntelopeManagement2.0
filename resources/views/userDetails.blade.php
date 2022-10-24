@extends('layouts.auth')

@section('title', 'Add User Details')

@section('content')
<img src="/images/logo.png" alt="">

<h1>Add Extra Details - {{$user->name}}</h1>

<form action="{{ route('storeUserDetail') }}" method="post">
    @csrf 

    <input type="text" name="user_id" id="user_id" value="{{$user->id}}" style="display: none;">

    <label for="Employer_id">Employer:</label>
    <select name="employer_id" id="employer_id">
        <option value="">Select...</option>
        @foreach($employers as $employer)
        <option value="{{$employer->id}}">{{$employer->employer}}</option>
        @endforeach
    </select>

    <label for="userType_id">Access Level:</label>
    <select name="userType_id" id="userType_id">
        <option value="">Select...</option>
        @foreach($userTypes as $userType) 
        <option value="{{$userType->id}}">{{$userType->userType}}</option>
        @endforeach
    </select>

    <input type="submit" value="Save">
</form>
@endsection