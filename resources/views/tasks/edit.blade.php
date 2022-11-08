@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
@if($user->id === $task->user_id)
<h1>Edit Task - {{$task->name}}</h1>

<section>
    <form action="{{ route('updateTask', $task->id) }}" method="post">
        @csrf  @include('includes.error')

        <input type="text" name="id" id="id" value="{{$task->id}}" style="display:none;">

        <label for="name">Task Title</label>
        <input type="text" name="name" id="name" value="{{$task->name}}">

        <label for="deadline">Deadline for completion:</label>
        <input type="datetime-local" style="width:99.5%;" name="deadline" id="deadline" value="{{$task->deadline}}">

        <label for="description">Task Description:</label>
        <textarea name="description" id="description">{{$task->description}}</textarea>
        
        <input type="submit" value="Save">

    </form>
    <button class="cancelButton"><a href="/ProjectsDashboard/project/task/{{$task->id}}">Cancel</a></button>
</section>

@else
<div class="hiddenForm">
    <h1>Sorry, you do not have access to this page.</h1>
    <p>Only the user who created the task can update the task.</p>
    <a href="/ProjectsDashboard/project/task/{{$task->id}}"><button class="back">Go Back</button></a>
</div>
@endif
@endsection