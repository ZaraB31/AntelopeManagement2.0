@extends('layouts.app')

@section('title', 'Edit Contact')

@section('content')
<h1>Edit Contact - {{$contact->name}}</h1>
<section>
    <form action="{{ route('updateContact', $contact->id) }}" method="post">
        @include('includes.error')  

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{$contact->name}}">

        <label for="phone">Phone Number:</label>
        <input type="number" name="phone" id="phone" value="0{{$contact->phone}}">

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="{{$contact->email}}">

        <input type="submit" value="Save">
    </form>

    <button class="cancelButton"><a href="/ContactBook">Cancel</a></button>
</section>
@endsection