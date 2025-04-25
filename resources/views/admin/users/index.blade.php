@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">
    <h1>Manage Users</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>fullName</th>
                <th>Email</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->fullName }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}">Update</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
@endsection
