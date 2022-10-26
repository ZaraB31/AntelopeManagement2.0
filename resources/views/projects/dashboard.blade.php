@extends('layouts.app')

@section('title', 'Projects Dashboard')

@section('content')
<h1>Projects Dashboard</h1>

<section>
    <table class="fullTable">
        <tr>
            <th colspan="4">Projects</th>
            <th><button><a href="/ProjectDashboard/create">Add New</a></button></th>
        </tr>
        @foreach($projects as $project)
        <tr>
            <td>{{$project->name}}</td>
            <td>{{$project->company->company}}</td>
            <td>{{$project->projectType->projectType}}</td>
            <td>progress</td>
            @if($project->completed === 1)
            <td>Completed</td>
            @else
            <td>In Progress</td>
            @endif
        </tr>
        @endforeach
    </table>
</section>
@endsection