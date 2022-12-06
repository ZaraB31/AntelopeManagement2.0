@extends('layouts.app')

@section('title', 'Jobs - Create')

@section('content')
    <h1>Create a new job</h1>

    <section>
        <form action="" method="post">
            @include('includes.error')

            <label for="name">Job Name:</label>
            <input type="text" name="name" id="name">

            <label for="description">Job Description:</label>
            <textarea name="description" id="description"></textarea>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location">

            <label for="start">Start Date/Time:</label>
            <input type="datetime-local" name="start" id="start">

            <label for="finish">Finish Date/Time:</label>
            <input type="datetime-local" name="finish" id="finish">

            <label for="employer_id">Job Ownership:</label>
            <select name="employer_id" id="employer_id">
                <option value="">Select...</option>
                @foreach($employers as $employer)
                <option value="{{$employer->id}}">{{$employer->employer}}</option>
                @endforeach
            </select>

            <label for="user_id">Assigned to the job:</label>
            <article>
                @foreach($userDetails as $userDetail)
                <div>
                    <input type="checkbox" name="user_id[]" id="user_id" value="{{$userDetail->user->id}}">
                    <label for="user_id">{{$userDetail->user->name}}</label>
                </div>
                @endforeach
            </article>
            <input type="submit" value="Create Job">
        </form>
        <button class="cancelButton"><a href="/Jobs">Cancel</a></button>
    </section>
@endsection