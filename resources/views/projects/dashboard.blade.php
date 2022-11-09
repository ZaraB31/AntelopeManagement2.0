@extends('layouts.app')

@section('title', 'Projects Dashboard')

@section('content')
<h1>Projects Dashboard</h1>

<section>
    <table class="fullTable">
        <tr>
            <th colspan="3">Projects</th>
            <th><button><a href="/ProjectsDashboard/create"><i class="fa-solid fa-plus"></i> Add New</a></button></th>
        </tr>
        @if($projects->count() > 0)
        @foreach($projects as $project)
        @if($project->completed === 0 or $project->completed === 1 and $projectTimeLeft[$project->id] !== 'Overdue')
        <tr>
            <td><a href="/ProjectsDashboard/project/{{$project->id}}">{{$project->name}} <i class="fa-solid fa-arrow-right"></i></a></td>

            @if($projectTimeLeft[$project->id] === 'Today')
                <td>Due {{$projectTimeLeft[$project->id]}} ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @elseif($projectTimeLeft[$project->id] === 'Overdue')
                <td style="background-color:#C20309;">Project {{$projectTimeLeft[$project->id]}} ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @else 
                <td>Due in {{$projectTimeLeft[$project->id]}} Days ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @endif

            @if($percentage[$project->id] === 100)
            <td style="background-color: #69C203;">{{$percentage[$project->id]}}% Completed</td>
            @else 
            <td>{{$percentage[$project->id]}}% Completed</td>
            @endif

            @if($project->completed === 1)
            <td style="background-color: #69C203;">Completed</td>
            @else
            <td>In Progress</td>
            @endif
        </tr>
        @endif
        @endforeach
        @else
        <tr>
            <td colspan="4">No projects added</td>
        </tr>
        @endif
    </table>
</section>
@endsection