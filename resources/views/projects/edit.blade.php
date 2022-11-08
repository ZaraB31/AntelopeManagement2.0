@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
@if($user->id === $project->user_id)
<h1>Edit Project - {{$project->name}}</h1>

<section>
    <form action="{{ route('updateProject', $project->id) }}" method="post">
        @csrf  @include('includes.error')

        <input type="text" name="id" id="id" value="{{$project->id}}" style="display:none;">

        <label for="name">Project Title:</label>
        <input type="text" name="name" id="name" value="{{$project->name}}">

        <div class="inputContainer">
            <div class="halfInput">
                <label for="deadline">Deadline Date:</label>
                <input type="datetime-local" name="deadline" id="deadline" value="{{$project->deadline}}">
            </div>

            <div class="halfInput">
                <label for="projectType_id">Project Type:</label>
                <select name="projectType_id" id="projectType_id">
                    @foreach($projectTypes as $projectType)
                    @if($projectType->id === $project->projectType_id)
                    <option value="{{$projectType->id}}">{{$projectType->projectType}}</option>
                    @else
                    <option value="{{$projectType->id}}">{{$projectType->projectType}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="halfInput">
                <label for="company_id">Company:</label>
                <select name="company_id" id="company_id">
                    @foreach($companies as $company)
                    @if($company->id === $project->company_id)
                    <option value="{{$company->id}}">{{$company->company}}</option>
                    @else
                    <option value="{{$company->id}}">{{$company->company}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="halfInput">
                <label for="employer_id">Project Ownership:</label>
                <select name="employer_id" id="employer_id">
                    @foreach($employers as $employer)
                    @if($employer->id === $project->employer_id)
                    <option value="{{$employer->id}}">{{$employer->employer}}</option>
                    @else
                    <option value="{{$employer->id}}">{{$employer->employer}}</option> 
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        <label for="description">Project Description:</label>
        <textarea name="description" id="description">{{$project->description}}</textarea>

        <input type="submit" value="Save">

    </form>
    <button class="cancelButton"><a href="/ProjectsDashboard/project/{{$project->id}}">Cancel</a></button>
</section>

@else
<div class="hiddenForm">
    <h1>Sorry, you do not have access to this page.</h1>
    <p>Only the user who created the project can update the project.</p>
    <a href="/ProjectsDashboard/project/{{$project->id}}"><button class="back">Go Back</button></a>
</div>
@endif

@endsection