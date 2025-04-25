@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">

    <h1>Update User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" id="fullName" value="{{ $user->fullName }}">

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <button type="submit">Update</button>
    </form>
@endsection
