@extends('layouts.app')

@section('title', 'Contact Book')

@section('content')
 
<section class="buttonSection">
    <h1>Contact Book</h1>
    <button onClick="openForm('companyCreateForm')">Add New Company</button>
</section>

<section>
    
    <article>
        <div class="tab">
            @foreach($companies as $company)
            <button class="tabLink" onClick="openCompany(event, '{{$company->id}}')">{{$company->company}}</button>
            @endforeach
        </div>

        @foreach($companies as $company)
        <div id="{{$company->id}}" class="tabContent" style="display: none;">
            <h2>{{$company->company}}</h2> <button><a href="/Company/{{$company->id}}/Contact/create">Add New Contact</a></button>
            
            @foreach($contacts as $contact)
            @if($contact->company_id === $company->id)
            <div class="tabContact">
                <h3>{{$contact->name}}</h3>
                <p><b>Email Address:</b> {{$contact->email}}</p>
                <p><b>Phone Number:</b> 0{{$contact->phone}}</p>
            </div>
            @endif  
            @endforeach
            
        </div>
        @endforeach
    </article>
</section>

<div class="hiddenForm" id="companyCreateForm" style="display:none;">
    <h3>Add New Company</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('companyCreateForm')"></i>

    <form action="{{ route('createCompany') }}" method="post">
        @csrf  @include('includes.error')
        <label for="company">Company:</label>
        <input type="text" name="company" id="company">

        <input type="submit" value="Save">
    </form>
</div>
@endsection