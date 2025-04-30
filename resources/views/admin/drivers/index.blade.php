@extends('admin.layout')
<link rel="stylesheet" href="{{ asset('css/manage-drivers.css') }}">

@section('content')
<div class="manage-drivers-wrapper">
    <h1>Manage Drivers</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.drivers.create') }}">+ Add Driver</a>

    <div>
        <h2>List of Drivers</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Driver Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->id }}</td>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->email }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->address }}</td>
                        <td>
                            <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="update-btn">Update</a>

                            <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <script>
                    function confirmDelete() {
                        return confirm('Are you sure you want to delete this driver?');
                    }
                </script>
            </tbody>
        </table>
    </div>
</div>
@endsection
