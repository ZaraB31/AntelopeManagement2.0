@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <section class="buttonSection">
        <h1>Jobs</h1>
        <a href="/Jobs/create"><button><i class="fa-solid fa-plus"></i> Add New</button></a>
    </section>

    @php
        $html = App\Http\Controllers\ScheduleController::calendar();
    @endphp

    <section>
        {{ $html }}
    </section>
@endsection