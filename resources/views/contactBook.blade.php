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
            @if($companies->count() > 0)
            @foreach($companies as $company)
            <button class="tabLink" onClick="openCompany(event, '{{$company->id}}')">{{$company->company}}</button>
            @endforeach
            @else
            <div class="tabLink"><p>No companies added yet</p></div>
            @endif
        </div>
        @foreach($companies as $company)
        <div id="{{$company->id}}" class="tabContent" style="display: none;">
            <h2>{{$company->company}} 
                <a onClick="openEditForm('companyEditForm', '{{$company->id}}', '{{$company->company}}')"><i class="fa-solid fa-pen-to-square"></i></a>
                <a onClick="openDeleteForm('companyDeleteForm', '{{$company->id}}', '{{$company->company}}')"><i class="fa-solid fa-trash-can"></i></a>
            </h2> 
            <button><a href="/Company/{{$company->id}}/Contact/create">Add New Contact</a></button>
            
            @foreach($contacts as $contact)
            @if($contact->company_id === $company->id)
            <div class="tabContact">
                <h3>{{$contact->name}}
                    <a href="/Company/Contact/{{$contact->id}}/update"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a onClick="openDeleteForm('contactDeleteForm', '{{$contact->id}}', '{{$contact->name}}')"><i class="fa-solid fa-trash-can"></i></a>
                </h3>
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

<div class="hiddenForm" id="companyEditForm" style="display:none;">
    <h3>Edit Company Details</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('companyEditForm')"></i>

    <form action="{{ route('updateCompany') }}" method="post">
        @csrf  @include('includes.error')

        <input type="text" name="id" id="id" style="display: none;">
        <label for="company">Company:</label>
        <input type="text" name="company" id="name">

        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="contactDeleteForm" style="display:none;">
    <h3 id="title">Delete Contact - </h3>
    <p>Are you sure you want to delete this contact?</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('contactDeleteForm')"></i>

    <form action="{{ route('deleteContact') }}" method="post">
        @csrf  @include('includes.error')

        <input type="text" name="id" id="id" style="display: none;">

        <input type="submit" value="Delete">
    </form>
    <button class="cancel" onClick="closeForm('contactDeleteForm')">Cancel</button>
</div>

<div class="hiddenForm" id="companyDeleteForm" style="display:none;">
    <h3 id="title">Delete Company - </h3>
    <p>Are you sure you want to delete this company? Doing this will also delete all of the company's data, including contacts and projects.</p>
    <i class="fa-solid fa-xmark" onClick="closeForm('companyDeleteForm')"></i>

    <form action="{{ route('deleteCompany') }}" method="post">
        @csrf  @include('includes.error')

        <input type="text" name="id" id="id" style="display: none;">

        <input type="submit" value="Delete">
    </form>
    <button class="cancel" onClick="closeForm('companyDeleteForm')">Cancel</button>
</div>
@endsection