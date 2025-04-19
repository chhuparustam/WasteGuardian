@extends('admin.layout')
<link rel="stylesheet" href="{{ asset('css/admin-driver.css') }}">

@section('content')
    <h2>Add Driver</h2>
    <form method="POST" action="{{ route('admin.drivers.store') }}">
        @csrf
        <input name="name" placeholder="Name" required><br><br>
        <input name="email" type="email" placeholder="Email" required><br><br>
        <input name="phone" placeholder="Phone" required><br><br>
        <input name="address" placeholder="Address"><br><br>
        <input name="password" type="password" placeholder="Password" required><br><br>
        <button type="submit">Add Driver</button>
    </form>
@endsection
