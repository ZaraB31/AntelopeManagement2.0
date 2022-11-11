@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
@if($accessLevel->userType_id === 1)
<h1>Admin Dashboard</h1>

<section class="halfSection">
    <table>
        <tr>
            <th>System Users</th>
            <th><button><i class="fa-solid fa-plus"></i> Add New</button></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td onClick="usersTableOpen({{$user->id}})">{{$user->name}}<i id="{{$user->id}} icon" class="fa-solid fa-chevron-down"></i></td>
            <td><a href="/Admin/User/{{$user->id}}/update"><i style="float:right;" class="fa-solid fa-pen-to-square"></i></a></td>
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
            <th><button onClick="openForm('UserTypeCreateForm')"><i class="fa-solid fa-plus"></i> Add New</button></th>
        </tr>
        @foreach($userTypes as $userType)
        <tr>
            <td colspan="2">{{$userType->userType}} <i onClick="openEditForm('UserTypeUpdateForm', '{{$userType->id}}', '{{$userType->userType}}')" class="fa-solid fa-pen-to-square"></i></td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <th>Employers</th>
            <th><button onClick="openForm('EmployersCreateForm')"><i class="fa-solid fa-plus"></i> Add New</button></th>
        </tr>
        @foreach($employers as $employer)
        <tr>
            <td colspan="2">{{$employer->employer}} <i onClick="openEditForm('EmployersUpdateForm', '{{$employer->id}}', '{{$employer->employer}}')" class="fa-solid fa-pen-to-square"></i></td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <th>Project Types</th>
            <th><button onClick="openForm('ProjectTypeCreateForm')"><i class="fa-solid fa-plus"></i> Add New</button></th>
        </tr>
        @foreach($projectTypes as $projectType)
        <tr>
            <td colspan="2">{{$projectType->projectType}} <i onClick="openEditForm('ProjectTypeUpdateForm', '{{$projectType->id}}', '{{$projectType->projectType}}')" class="fa-solid fa-pen-to-square"></i></td>
        </tr>
        @endforeach
    </table>
</section>

<div class="hiddenForm" id="UserTypeCreateForm" style="display:none;">
    <h3><i class="fa-solid fa-plus"></i> Add New User Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('UserTypeCreateForm')"></i>

    <form action="{{ route('createUserType') }}" method="post">
        @csrf  
        
        @if ($errors->userTypes->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->userTypes->all() as $error)
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

<div class="hiddenForm" id="UserTypeUpdateForm" style="display:none;">
    <h3>Update User Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('UserTypeUpdateForm')"></i>

    <form action="{{ route('updateUserType') }}" method="post">
        @csrf  
        
        @if ($errors->updateUserTypes->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->updateUserTypes->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="id" id="id" style="display:none;">

        <label for="userType">User Type:</label>
        <input type="text" name="userType" id="name">

        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('UserTypeUpdateForm')">Cancel</button>
</div>

<div class="hiddenForm" id="EmployersCreateForm" style="display:none;">
    <h3><i class="fa-solid fa-plus"></i> Add New Employer</h3>
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

<div class="hiddenForm" id="EmployersUpdateForm" style="display:none;">
    <h3>Update Employer Details</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('EmployersUpdateForm')"></i>

    <form action="{{ route('updateEmployer') }}" method="post">
        @csrf  
        
        @if ($errors->updateEmployers->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->updateEmployers->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="id" id="id" style="display:none;">

        <label for="employer">Employer name:</label>
        <input type="text" name="employer" id="name">

        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('UserTypeUpdateForm')">Cancel</button>
</div>

<div class="hiddenForm" id="ProjectTypeCreateForm" style="display:none;">
    <h3><i class="fa-solid fa-plus"></i> Add New Project Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('ProjectTypeCreateForm')"></i>

    <form action="{{ route('createProjectType') }}" method="post">
        @csrf  
        
        @if ($errors->projectTypes->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->projectTypes->all() as $error)
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

<div class="hiddenForm" id="ProjectTypeUpdateForm" style="display:none;">
    <h3><i class="fa-solid fa-plus"></i> Add New Project Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('ProjectTypeUpdateForm')"></i>

    <form action="{{ route('updateProjectType') }}" method="post">
        @csrf  
        
        @if ($errors->updateProjectTypes->any())
            <div class="errorAlert" id="errorAlert">
                <ul>
                    @foreach ($errors->updateProjectTypes->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="text" name="id" id="id" style="display:none;">

        <label for="projectType">Project Type:</label>
        <input type="text" name="projectType" id="name">

        <input type="submit" value="Save">
    </form>
    <button class="cancel" onClick="closeForm('UserTypeUpdateForm')">Cancel</button>
</div>

@else
<div class="hiddenForm">
    <h1>Sorry, you do not have access to this page</h1>
</div>
@endif
@endsection