@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-requests.css') }}">
    <h1>Manage Requests</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Address</th>
                <th>Nearest Landmark</th>
                <th>Photo</th>
                <th>Message</th>
                <th>Requested At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->address }}</td>
                    <td>{{ $request->landmark }}</td>
                    <td><img src="{{ asset('storage/' . $request->photo) }}" width="100"></td>
                    <td>{{ $request->message }}</td>
                    <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
