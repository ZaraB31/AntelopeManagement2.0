@extends('layouts.field')

@section('title', 'Schedule')

@section('content')
    <h1>Schedule</h1>

    @php
        $html = App\Http\Controllers\ScheduleController::calendar();
    @endphp

    <section>
        {{ $html }}
    </section>
@endsection