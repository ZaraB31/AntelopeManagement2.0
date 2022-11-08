@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Hello {{$user->name}}</h1>

<section>
    <table class="fullTable">
        <tr>
            <th colspan="4">Upcoming Tasks</th>
        </tr>
        @if($userTasks->count() > 0)
        @foreach($userTasks->sortBy(function ($task) {
            return $task->task->deadline;
        }); as $task)
        @if($task->task->completed === 0)
        <tr>
            <td><a href="/ProjectsDashboard/project/task/{{$task->task->id}}">{{$task->task->name}} <i class="fa-solid fa-arrow-right"></i></a></td>
            <td>{{$task->task->project->name}}</td>
            <td>{{$task->task->project->projectType->projectType}}</td>
            @if($taskTimeLeft[$task->id] === 'Today')
                <td>Due {{$taskTimeLeft[$task->id]}} ( {{date('j F Y, g:i a', strtotime($task->task->deadline))}} )</td>
            @elseif($taskTimeLeft[$task->id] === 'Overdue')
                <td style="background-color:#C20309;">Task {{$taskTimeLeft[$task->id]}} ( {{date('j F Y, g:i a', strtotime($task->task->deadline))}} )</td>
            @else 
                <td>Due in {{$taskTimeLeft[$task->id]}} Days ( {{date('j F Y, g:i a', strtotime($task->task->deadline))}} )</td>
            @endif
        </tr>
        @endif
        @endforeach
        @else 
        <tr>
            <td>No Upcoming Tasks</td>
        </tr>
        @endif
        </table>
</section>

<section>
    <table class="threeTable">
        <tr>
            <th colspan="2">Your Projects</th>
        </tr>
        @if($userProjects->count() > 0)
        @foreach($userProjects as $project)
        @if($project->completed === 0)
        <tr>
            <td><a href="/ProjectsDashboard/project/{{$project->id}}">{{$project->name}}<i class="fa-solid fa-arrow-right"></i></a></td>
            @if($projectTimeLeft[$project->id] === 'Today')
                <td>Due {{$projectTimeLeft[$project->id]}} ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @elseif($projectTimeLeft[$project->id] === 'OverDue')
                <td class="overdue">project {{$projectTimeLeft[$project->id]}} ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @else 
                <td>Due in {{$projectTimeLeft[$project->id]}} Days ( {{date('j F Y, g:i a', strtotime($project->deadline))}} )</td>
            @endif
        </tr>
        @endif
        @endforeach
        @else 
        <tr>
            <td>No Projects Created</td>
        </tr>
        @endif
    </table>
</section>
@endsection
