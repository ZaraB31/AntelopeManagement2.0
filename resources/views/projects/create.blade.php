@extends('layouts.app')

@section('title', 'Add New Project')

@section('content')
<h1><i class="fa-solid fa-plus"></i> Add New Project</h1>
<section>
    <form action="{{ route('storeProject') }}" method="post">
        @csrf  @include('includes.error') 

        <label for="name">Project Title:</label>
        <input type="text" name="name" id="name">

        <div class="inputContainer">
            <div class="halfInput">
                <label for="deadline">Deadline Date:</label>
                <input type="datetime-local" name="deadline" id="deadline">
            </div>

            <div class="halfInput">
                <label for="projectType_id">Project Type:</label>
                <select name="projectType_id" id="projectType_id">
                    <option value="">Select...</option>
                    @foreach($projectTypes as $projectType)
                    <option value="{{$projectType->id}}">{{$projectType->projectType}}</option>
                    @endforeach
                </select>
            </div>

            <div class="halfInput">
                <label for="company_id">Company:</label>
                <select name="company_id" id="company_id">
                    <option value="">Select...</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company}}</option>
                    @endforeach
                </select>
            </div>

            <div class="halfInput">
                <label for="employer_id">Project Ownership:</label>
                <select name="employer_id" id="employer_id">
                    <option value="">Select...</option>
                    @foreach($employers as $employer)
                    <option value="{{$employer->id}}">{{$employer->employer}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <label for="description">Project Description:</label>
        <textarea name="description" id="description"></textarea>

        <input type="number" name="completed" id="completed" value="0" style="display: none;">

        
        <input type="submit" value="Save">
    </form>

    <button class="cancelButton"><a href="/ProjectsDashboard">Cancel</a></button>
</section>
@endsection