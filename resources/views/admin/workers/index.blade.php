@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-workers.css') }}">

<div class="manage-workers-wrapper">
    <h1>Manage Workers</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Specialization</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($workers as $worker)
            <tr>
                <td>{{ $worker->id }}</td>
                <td>
                    @if($worker->photo)
                        <img src="{{ asset('storage/' . $worker->photo) }}" alt="Worker Photo" width="40" height="40" style="border-radius:50%;">
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
                <td>{{ $worker->name }}</td>
                <td>
                    @if(isset($worker->role))
                        <span class="role-badge">{{ ucfirst($worker->role) }}</span>
                    @else
                        <span class="text-muted">feild staff</span>
                    @endif
                </td>
                <td>{{ $worker->email }}</td>
                <td>{{ $worker->phone }}</td>
                <td>{{ $worker->address }}</td>
                <td>{{ $worker->specialization }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="" class="btn-update">Update</a>
                       
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No workers found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection