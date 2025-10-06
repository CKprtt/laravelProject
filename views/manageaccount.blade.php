@extends('super_admin_nav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        select{
            margin: 10px 0px 10px 0px;
        }
        
    </style>
</head>
<body>
@section('content')
    <h1>Management Account</h1>
    <form method="GET" action="{{ route('ManageAccount') }}">
        <label for="usertype">Filter :</label>
        <select name="usertype" id="usertype" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="user" {{ request('usertype') == 'user' ? 'selected' : '' }}>User</option>
            <option value="artist" {{ request('usertype') == 'artist' ? 'selected' : '' }}>Artist</option>
            <option value="admin" {{ request('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="super_admin" {{ request('usertype') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
        </select>
    </form>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
            @foreach ($user as $i)
            <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->email }}</td>
                    <td>{{ $i->usertype }}</td>
                    <td>{{ $i->created_at }}</td>
                    <td>{{ $i->updated_at }}</td>
                    <td>
                        <a href="{{ route('Manage.edit', ['id' => $i->id]) }}">Edit</a> | <a href="{{ route('Manage.destroy', ['id' => $i->id]) }}" onclick="return confirm('Are you sure you want to delete this')">Delete</a>
                    </td>
            </tr>
            @endforeach
    
    </table>
    <a href="/dashboard">Back</a>
@endsection
</body>
</html>