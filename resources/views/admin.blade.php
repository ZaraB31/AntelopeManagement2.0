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
            <th><button>Add New</button></th>
        </tr>
        <tr>
            <td colspan="2">Admin</td>
        </tr>
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
@endsection