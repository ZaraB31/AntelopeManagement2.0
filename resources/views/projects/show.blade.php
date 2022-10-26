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
    <p><b>Deadline to be completed by:</b> {{ date('j F Y, g:i a', strtotime($project->deadline)) }}</p>
    <p><b>Overseen By:</b> {{$project->employer->employer}}</p>
    <p><b>Project Type:</b> {{$project->projectType->projectType}}</p>
    <p>{{$project->description}}</p>
</section>

<section class="halfSection">

    <table>
        <tr>
            <th>Tasks</th>
            <th><button>Add New</button></th>
        </tr>
    </table>

    <table>
        <tr>
            <th>Contacts</th>
            <th><button>Link Contact</button></th>
        </tr>
    </table>
</section>

<section class="halfSection">
    <table>
        <tr>
            <th>Notes</th>
            <th><button>Add New</button></th>
        </tr>
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
@endsection