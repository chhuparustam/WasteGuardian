@extends('admin.layout')

@section('content')
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <button type="submit">Update</button>
    </form>
@endsection
