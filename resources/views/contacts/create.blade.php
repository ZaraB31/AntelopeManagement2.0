@extends('layouts.app')

@section('title', 'Create New Contact')

@section('content')
<h1><i class="fa-solid fa-plus"></i> Add New company contact - {{$company->company}}</h1>
<section>
    <form action="{{ route('storeContact') }}" method="post">
        @include('includes.error')  

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="phone">Phone Number:</label>
        <input type="number" name="phone" id="phone">

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email">

        <input type="text" name="company_id" id="company_id" value="{{$company->id}}" style="display:none;">

        <input type="submit" value="Save">
    </form>

    <button class="cancelButton"><a href="/ContactBook">Cancel</a></button>
</section>
@endsection