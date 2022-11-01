@extends('layouts.app')

@section('title', $task->name)

@section('content')

<section class="backButton">
    <a href="/ProjectsDashboard/project/{{$task->project_id}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
</section>

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
                <th><button onClick="openForm('AssignUserForm')">Assign user</button></th>
            </tr>
        </thead>
        <tbody  colspan="2">
            @if($taskUsers->count() > 0)
            @foreach($taskUsers as $taskUser)
            <tr>
                <td>{{$taskUser->user->name}}</td>
            </tr>
            @endforeach
            @else 
            <tr>
                <td>No users assigned yet</td>
            </tr>
            @endif
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

<div class="hiddenForm" id="TaskCompleteForm" style="display:none;">
    @if($authUser === $task->user_id)
    <h3>Are you sure you want to mark this task as completed?</h3>
    <p>Once you mark this as completed, it can not be undone.</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('TaskCompleteForm')"></i>

    <form action="{{ route('completeTask') }}" method="post">
        @csrf 

        <input type="text" name="id" id="id" value="{{$task->id}}" style="display:none;">

        <input type="submit" value="Complete">
    </form>

    <button class="cancel" onClick="closeForm('TaskCompleteForm')">Cancel</button>
    @else 
    <h3>You can not mark this task as completed.</h3>
    <p>This task can only be marked as completed by the user who created it.</p>
    <button onClick="closeForm('TaskCompleteForm')">Back</button>
    @endif
</div>


<div class="hiddenForm" id="AssignUserForm" style="display:none;">
    @if($authUser === $task->user_id)
    <h3>Assign a user to complete this task.</h3>

    <i class="fa-solid fa-xmark" onClick="closeForm('AssignUserForm')"></i>

    <form action="{{ route('assignUser') }}" method="post">
        @csrf 

        @if ($errors->assignUser->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->assignUser->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="task_id" id="task_id" value="{{$task->id}}" style="display:none;">

        <select name="user_id" id="user_id">
            <option value="">Select User</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>

        <input type="submit" value="Complete">
    </form>

    <button class="cancel" onClick="closeForm('AssignUserForm')">Cancel</button>
    @else 
    <h3>You can not assign users to this task.</h3>
    <p>Users can only be assigned by the task creator.</p>
    <button onClick="closeForm('AssignUserForm')">Back</button>
    @endif
</div>
@endsection