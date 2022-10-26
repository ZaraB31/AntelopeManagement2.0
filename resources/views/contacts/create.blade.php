@extends('layouts.app')

@section('title', 'Create New Contact')

@section('content')
<h1>Add new company contact - {{$company->company}}</h1>
<section>
    <form action="" method="post">
        @csrf  @include('includes.error') 

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="phone">Phone Number:</label>
        <input type="number" name="phone" id="phone">

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email">

        <input type="text" name="company_id" id="company_id" value="{{$company->id}}" style="display:none;">

        <button>Cancel</button>
        <input type="submit" value="Save">
    </form>
</section>
@endsection