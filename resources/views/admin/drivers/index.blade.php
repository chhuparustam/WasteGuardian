@extends('admin.layout')

@section('content')
    <h2>All Drivers</h2>
    <a href="{{ route('admin.drivers.create') }}">Add New Driver</a>
    <table>
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>{{ $driver->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
