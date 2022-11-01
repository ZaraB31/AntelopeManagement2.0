@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
@if($accessLevel->userType_id === 1)
<h1>Admin Dashboard</h1>
<section class="halfSection">
    <table>
        <tr>
            <th>System Users</th>
            <th><button>Add New</button></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td onClick="usersTableOpen({{$user->id}})" colspan="2">{{$user->name}}<i id="{{$user->id}} icon" class="fa-solid fa-chevron-down"></i></td>
        </tr>
        <tr>
            <td id="{{$user->id}} email" class="hiddenRow" colspan="2"><b>Email: </b>{{$user->email}}</td>
        </tr>
        @foreach($userDetails as $userDetail)
        @if($userDetail->user_id === $user->id)
        <tr>
            <td id="{{$user->id}} employer" class="hiddenRow" colspan="2"><b>Employer:</b> {{$userDetail->employer->employer ?? 'None'}}</td>
        </tr>
        <tr>
            <td id="{{$user->id}} type" class="hiddenRow" colspan="2"><b>User Type:</b> {{$userDetail->userType->userType ?? 'None'}}</td>
        </tr>
        @endif
        @endforeach
        @endforeach
    </table>
</section>
<section class="halfSection">
    <table>
        <tr>
            <th>User Types</th>
            <th><button onClick="openForm('UserTypeCreateForm')">Add New</button></th>
        </tr>
        @foreach($userTypes as $userType)
        <tr>
            <td colspan="2">{{$userType->userType}}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <th>Employers</th>
            <th><button onClick="openForm('EmployersCreateForm')">Add New</button></th>
        </tr>
        @foreach($employers as $employer)
        <tr>
            <td colspan="2">{{$employer->employer}}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <th>Project Types</th>
            <th><button onClick="openForm('ProjectTypeCreateForm')">Add New</button></th>
        </tr>
        @foreach($projectTypes as $projectType)
        <tr>
            <td colspan="2">{{$projectType->projectType}}</td>
        </tr>
        @endforeach
    </table>
</section>

<div class="hiddenForm" id="UserTypeCreateForm" style="display:none;">
    <h3>Add New User Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('UserTypeCreateForm')"></i>

    <form action="{{ route('createUserType') }}" method="post">
        @csrf  
        
        @if ($errors->userType->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->userType->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="userType">User Type:</label>
        <input type="text" name="userType" id="userType">

        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="EmployersCreateForm" style="display:none;">
    <h3>Add New Employer</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('EmployersCreateForm')"></i>

    <form action="{{ route('createEmployer') }}" method="post">
        @csrf  
        
        @if ($errors->employers->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->employers->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="employer">Employer name:</label>
        <input type="text" name="employer" id="employer">

        <input type="submit" value="Save">
    </form>
</div>

<div class="hiddenForm" id="ProjectTypeCreateForm" style="display:none;">
    <h3>Add New Project Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('ProjectTypeCreateForm')"></i>

    <form action="{{ route('createProjectType') }}" method="post">
        @csrf  
        
        @if ($errors->projectType->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->projectType->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="projectType">Project Type:</label>
        <input type="text" name="projectType" id="projectType">

        <input type="submit" value="Save">
    </form>
</div>
@else
<h1>Sorry, you do not have access to this page.</h1>
@endif
@endsection