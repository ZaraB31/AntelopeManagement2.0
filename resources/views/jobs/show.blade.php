@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
<section class="backButton">
    <a href="/Schedule"><i class="fa-solid fa-arrow-left"></i> Back</a>
</section>

<section>
    <h1>{{$job->name}}</h1>
    <p><b>Location: </b>{{$job->location}}</p>
    <p>{{ date('j F Y, g:ia', strtotime($job->start)) }} - {{ date('j F Y, g:ia', strtotime($job->finish)) }}</p>
    <p>{{$job->description}}</p>
</section>

<section class="halfSection">
    <table class="tableHeight">
        <tr>
            <th>Completing the Job</th>
            <th><button>Add User</button></th>
        </tr>
        @foreach($jobUsers as $jobUser)
        <tr>
            <td>{{$jobUser->user->name}} <a href=""><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
        @endforeach
    </table>
</section>

<section class="halfSection">
    <table class="tableHeight">
        <tr>
            <th>Notes</th>
            <th><button onClick="openForm('CreateNoteForm')"><i class="fa-solid fa-plus"></i> Add Note</button></th>
        </tr>
        @if($jobNotes->count() > 0)
            @foreach($jobNotes as $note)
            <tr>
                <td>{{$note->user->name}}</td>
                <td>{{ date('j F Y, g:ia', strtotime($note->created_at)) }}</td>
            </tr>
            <tr class="noteContent">
                <td colspan="2">{{$note->note}}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="2">No Notes</td>
            </tr>
        @endif
    </table>
</section>

<div class="hiddenForm" id="CreateNoteForm" style="display:none;">
    <h3>Add Note</h3>

    <i class="fa-solid fa-xmark" onClick="closeForm('CreateNoteForm')"></i>

    <form action="{{ route('createScheduleNote') }}" method="post">
        @include('includes.error')

        <input type="text" name="schedule_id" id="schedule_id" value="{{$job->id}}" style="display:none;">

        <label for="note">Note:</label>
        <textarea name="note" id="note"></textarea>

        <input type="submit" value="Complete">
    </form>

    <button class="cancel" onClick="closeForm('CreateNoteForm')">Cancel</button>
</div>

@endsection