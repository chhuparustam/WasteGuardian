..
@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

<div class="manage-users-wrapper">
    <h1>Manage Workers</h1>

    <table>
        <thead>
            <tr>
            <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                    <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
        <td>{{ $worker->id }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->email }}</td>
                    <td>{{ $worker->phone }}</td>
                    <td>{{ $worker->specialization }}</td>
            <td>
            <a href="{{ route('admin.workers.edit', $worker->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.workers.destroy', $worker->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this worker?')">Delete</button>
                        </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
