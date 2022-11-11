@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h1>Edit User - {{$user->name}}</h1>

<section>
    <form action="{{ route('updateUser') }}" method="post">
        @csrf 
        @include('includes.error')
        
        <input type="text" name="id" id="id" value="{{$user->id}}" style="display:none;">
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{$user->name}}">

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">

        <label for="employer_id">Employer:</label>
        <select name="employer_id" id="employer_id">
            @foreach($employers as $employer)
            @if($employer->id === $userDetail->employer_id)
            <option value="{{$employer->id}}">{{$employer->employer}}</option>
            @else 
            <option value="{{$employer->id}}">{{$employer->employer}}</option>
            @endif
            @endforeach
        </select>

        <label for="userType_id">User Type:</label>
        <select name="userType_id" id="userType_id">
            @foreach($userTypes as $userType)
            @if($userType->id === $userDetail->userType_id)
            <option value="{{$userType->id}}">{{$userType->userType}}</option>
            @else 
            <option value="{{$userType->id}}">{{$userType->userType}}</option>
            @endif
            @endforeach
        </select>

        <input type="submit" value="Update">
    </form>
    <button class="cancelButton"><a href="/Admin">Cancel</a></button>
</section>
@endsection