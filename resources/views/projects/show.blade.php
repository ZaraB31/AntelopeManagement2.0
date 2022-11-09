@extends('layouts.app')

@section('title', $project->name)

@section('content')

<section class="backButton">
    <a href="/ProjectsDashboard"><i class="fa-solid fa-arrow-left"></i> Back</a>
</section>

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
    <button class="edit"><a href="/ProjectsDashboard/project/{{$project->id}}/edit">Edit</a></button>
    <button class="delete"><a href="">Delete</a></button>
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
            @if($projectTasks->count() > 0)
            @foreach($projectTasks as $task)
            <tr>
                <td><a href="/ProjectsDashboard/project/task/{{$task->id}}">{{$task->name}} <i class="fa-solid fa-arrow-right"></i></a></td>
                @if($task->completed === 0)
                <td>In Progress</td>
                @else
                <td style="background-color: #69C203;">Completed</td>
                @endif
            </tr>
            @endforeach
            @else 
            <tr>
                <td>No tasks added</td>
            </tr>
            @endif
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
            <th><button onClick="openForm('LinkContactForm')"><i class="fa-solid fa-link"></i>Link Contact</button></th>
        </tr>
        @if($projectContacts->count() > 0)
        @foreach($projectContacts as $projectContact)
        <tr>
            <td><i onClick="openDeleteForm('UnlinkContactForm', '{{$projectContact->id}}')" class="fa-solid fa-link-slash"></i> {{$projectContact->contact->company->company}}</td>
            <td>{{$projectContact->contact->name}}</td>
            <td>0{{$projectContact->contact->phone}}</td>
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
    @if($authUser === $project->user_id)
    <h3>Are you sure you want to mark this project as completed?</h3>
    <p>Once you mark this as completed, it can not be undone.</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('ProjectCompleteForm')"></i>

    <form action="{{ route('completeProject') }}" method="post">
        @csrf  

        <input type="text" name="id" id="id" value="{{$project->id}}" style="display:none;">
        
        <input type="submit" value="Complete">
    </form>
    <button class="cancel" onClick="closeForm('ProjectCompleteForm')">Cancel</button>
    @else 
    <h3>You can not mark this project as completed.</h3>
    <p>This project can only be marked as completed by the user who created it.</p>
    <button onClick="closeForm('ProjectCompleteForm')">Back</button>
    @endif
</div>


<div class="hiddenForm" id="LinkContactForm" style="display:none;">
    <h3>Link Project Contact</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('LinkContactForm')"></i>

    <form action="{{ route('linkContact') }}" method="post">
        @csrf 
        
        @if ($errors->linkContact->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->linkContact->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

        
        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('LinkContactForm')">Cancel</button>
</div>


<div class="hiddenForm" id="CreateNoteForm" style="display:none;">
    <h3>Add Note</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('CreateNoteForm')"></i>

    <form action="{{ route('addNote') }}" method="post">
        @csrf  
        
        @if ($errors->projectNote->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->projectNote->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <textarea name="note" id="note"></textarea>

        
        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('CreateNoteForm')">Cancel</button>
</div>


<div class="hiddenForm" id="CreateTaskForm" style="display:none;">
    <h3>Add Note</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('CreateTaskForm')"></i>

    <form action="{{ route('createTask') }}" method="post">
        @csrf  
        
        @if ($errors->projectTask->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->projectTask->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="deadline">Deadline for completion:</label>
        <input type="datetime-local" name="deadline" id="deadline">
        
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>

        
        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('CreateTaskForm')">Cancel</button>
</div>


<div class="hiddenForm" id="UnlinkContactForm" style="display:none;">
    <h3>Unlink Project Contact</h3>
    <p>Are you sure you want to unlink this contact?</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('UnlinkContactForm')"></i>

    <form action="{{ route('unlinkContact') }}" method="post">
        @csrf 

        <input type="text" name="id" id="id" style="display:none;">
        <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">

        <input type="submit" value="Unlink">

    </form>

    <button class="cancel" onClick="closeForm('UnlinkContactForm')">Cancel</button>
</div>
@endsection