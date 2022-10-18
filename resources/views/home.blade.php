@extends('layouts.app')

@section('content')
<h1>Hello User</h1>
<section>
    <table class="fullTable">
        <tr>
            <th colspan="3">Upcoming Tasks</th>
        </tr>
        <tr>
            <td>Task Name</td>
            <td>Project Name</td>
            <td>Deadline Date</td>
        </tr>
        <tr>
            <td>Task Name</td>
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
            <td>Project Name</td>
        </tr>
    </table>
</section>
@endsection
