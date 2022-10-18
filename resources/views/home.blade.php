@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Hello User</h1>
<section>
    <table class="fullTable">
        <tr>
            <th colspan="3">Upcoming Tasks</th>
        </tr>
        <tr>
            <td>Task Name   <i class="fa-solid fa-arrow-right"></i></td>
            <td>Project Name</td>
            <td>Deadline Date</td>
        </tr>
        <tr>
            <td>Task Name   <i class="fa-solid fa-arrow-right"></i></td>
            <td>Project Name</td>
            <td>Deadline Date</td>
        </tr>
    </table>
</section>
<section>
    <table class="halfTable">
        <tr>
            <th>Your Projects</th>
        </tr>
        <tr>
            <td>Project Name   <i class="fa-solid fa-arrow-right"></i></td>
        </tr>
    </table>
</section>
@endsection
