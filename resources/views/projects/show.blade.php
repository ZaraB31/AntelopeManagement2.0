@extends('layouts.app')

@section('title', $project->name)

@section('content')


<section class="buttonSection">
    <h1>{{$project->name}}</h1>
    @if($project->completed === 0)
    <button onClick="openForm('ProjectCompleteForm')">Mark as completed</button>
    @else
    <h2>Project completed</h2>
    @endif  
    
</section>

<section class="projectDetails">
    <p><b>To be completed by:</b> {{ date('j F Y, g:i a', strtotime($project->deadline)) }}</p>
    <p><b>Overseen By:</b> {{$project->employer->employer}}</p>
    <p><b>Project Type:</b> {{$project->projectType->projectType}}</p>
    <p><b>Company:</b> {{$project->company->company}}</p>
    <p><b>Created by:</b> {{$project->user->name}}</p>
    <p>{{$project->description}}</p>
</section>

<section class="actionButtons">
    <button class="edit">Edit</button>
    <button class="delete">Delete</button>
</section>

<section class="halfSection">
    <table class="tableHeight"> 
        <thead>
            <tr>
                <th>Tasks</th>
                <th><button onClick="openForm('CreateTaskForm')">Add New</button></th>
            </tr>
        </thead> 
        <tbody colspan="2">
            @foreach($projectTasks as $task)
            <tr>
                <td><a href="">{{$task->name}} <i class="fa-solid fa-arrow-right"></i></a></td>
                <td>{{date('j F Y, g:i a', strtotime($task->deadline))}}</td>
            </tr>
            @endforeach
        </tbody> 
    </table>
</section>

<section class="halfSection">
    <table class="tableHeight"> 
        <thead>
            <tr>
                <th>Notes</th>
                <th><button onClick="openForm('CreateNoteForm')">Add New</button></th>
            </tr>
        </thead> 
        <tbody colspan="2">
            @if($projectNotes->count() > 0) 
            @foreach($projectNotes as $note)
            <tr>
                <td>{{$note->user->name}} - {{date('j F Y, g:i a', strtotime($note->created_at))}}</td>
            </tr>
            <tr class="noteContent">
                <td>{{$note->note}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td>No Notes</td>
            </tr>
            @endif
        </tbody>
    </table>
</section>

<section class="fullSection">
    <table>
        <tr>
            <th colspan="3">Contacts</th>
            <th><button onClick="openForm('LinkContactForm')">Link Contact</button></th>
        </tr>
        @if($projectContacts->count() > 0)
        @foreach($projectContacts as $projectContact)
        <tr>
            <td>{{$projectContact->contact->company->company}}</td>
            <td>{{$projectContact->contact->name}}</td>
            <td>{{$projectContact->contact->phone}}</td>
            <td>{{$projectContact->contact->email}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">No Contacts Linked</td> 
        </tr>
        @endif
    </table>
</section>




<div class="hiddenForm" id="ProjectCompleteForm" style="display:none;">
    <h3>Are you sure you want to mark this project as completed?</h3>
    <p>Once you mark this as completed, it can not be undone.</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('ProjectCompleteForm')"></i>

    <form action="{{ route('completeProject') }}" method="post">
        @csrf  @include('includes.error')
        <input type="text" name="id" id="id" value="{{$project->id}}" style="display:none;">

        <button>Cancel</button>
        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="LinkContactForm" style="display:none;">
    <h3>Link Project Contact</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('LinkContactForm')"></i>

    <form action="{{ route('linkContact') }}" method="post">
        @csrf  @include('includes.error')
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <select name="contact_id" id="contact_id">
            <option value="">Select...</option>
            @foreach($companies as $company)
            <optgroup label="{{$company->company}}">
                @foreach($contacts as $contact)
                @if($contact->company_id === $company->id)
                <option value="{{$contact->id}}">{{$contact->name}}</option>
                @endif
                @endforeach
            </optgroup>
            @endforeach
        </select>

        <button>Cancel</button>
        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="CreateNoteForm" style="display:none;">
    <h3>Add Note</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('CreateNoteForm')"></i>

    <form action="{{ route('addNote') }}" method="post">
        @csrf  @include('includes.error')
        
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <textarea name="note" id="note"></textarea>

        <button>Cancel</button>
        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="CreateTaskForm" style="display:none;">
    <h3>Add Note</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('CreateTaskForm')"></i>

    <form action="{{ route('createTask') }}" method="post">
        @csrf  @include('includes.error')
        
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="deadline">Deadline for completion:</label>
        <input type="datetime-local" name="deadline" id="deadline">
        
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        <button>Cancel</button>
        <input type="submit" value="Save">
    </form>
</div>
@endsection