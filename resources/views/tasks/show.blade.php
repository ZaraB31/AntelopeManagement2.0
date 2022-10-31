@extends('layouts.app')

@section('title', $task->name)

@section('content')

<section class="buttonSection">
    <h1>{{$task->name}}</h1>
    @if($task->completed === 0)
    <button onClick="openForm('TaskCompleteForm')">Mark as completed</button>
    @else
    <h2>Task completed</h2>
    @endif   
</section>

<section class="projectDetails">
    <p><b>To be completed by:</b> {{date('j F Y, g:i a', strtotime($task->deadline))}}</p>
    <p><b>Created by:</b> {{$task->user->name}}</p>
    <p><b>Project:</b> {{$task->project->name}}</p>
    <p>{{$task->description}}</p>
</section>

<section class="actionButtons">
    <button class="edit">Edit</button>
    <button class="delete">Delete</button>
</section>

<section class="halfSection">
    <table class="tableHeight">
        <thead>
            <tr>
                <th>Users completeing the task</th>
                <th><button>Assign user</button></th>
            </tr>
        </thead>
        <tbody  colspan="2">
            <tr>
                <td>Example</td>
            </tr>
        </tbody>
    </table>

    <table class="tableHeight">
        <thead>
            <tr>
                <th>Notes</th>
                <th><button>Add Note</button></th>
            </tr>
        </thead>
        <tbody  colspan="2">
            <tr>
                <td>Example</td>
            </tr>
        </tbody>
    </table>
</section>

<section class="halfSection">
    <table class="tableHeight">
        <thead>
            <tr>
                <th>Task Documents</th>
                <th><button>Add New</button></th>
            </tr>
        </thead>
        <tbody  colspan="2">
            <tr>
                <td>Example</td>
            </tr>
        </tbody>
    </table>

    <table class="tableHeight">
        <thead>
            <tr>
                <th>Task Photos</th>
                <th><button>Add Note</button></th>
            </tr>
        </thead>
        <tbody  colspan="2">
            <tr>
                <td>Example</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection