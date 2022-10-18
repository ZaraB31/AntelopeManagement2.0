@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1>Admin Dashboard</h1>

<section>
    <table class="halfTable">
        <tr>
            <th>System Users</th>
            <th><button>Add New</button></th>
        </tr>
        <tr>
            <td colspan="2">User's name <i class="fa-solid fa-chevron-down"></i></td>
        </tr>
    </table>

    <table class="halfTable">
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

    <table class="halfTable">
        <tr>
            <th>Employers</th>
            <th><button>Add New</button></th>
        </tr>
        <tr>
            <td colspan="2">Mega Electrical</td>
        </tr>
    </table>

    <table class="halfTable">
        <tr>
            <th>Project Types</th>
            <th><button>Add New</button></th>
        </tr>
        <tr>
            <td colspan="2">Tender</td>
        </tr>
    </table>
</section>

<div class="hiddenForm" id="UserTypeCreateForm" style="display:none;">
    <h3>Add New User Type</h3>
    <i class="fa-solid fa-xmark" onClick="closeForm('UserTypeCreateForm')"></i>

    <form action="{{ route('createUserType') }}" method="post">
        @csrf
        <label for="userType">User Type:</label>
        <input type="text" name="userType" id="userType">

        <input type="submit" value="Save">
    </form>
</div>
@endsection