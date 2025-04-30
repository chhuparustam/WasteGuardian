<!-- resources/views/admin/drivers/edit.blade.php -->
@extends('admin.layout')
<link rel="stylesheet" href="{{ asset('css/edit-drivers.css') }}">

@section('content')
    <h1>Update Driver info.</h1>
    <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- PUT method is used to update data -->
        
        <div class="form-group">
            <label for="name">Driver's Name</label>
            <input type="text" name="name" value="{{ $driver->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $driver->email }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" value="{{ $driver->phone }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" value="{{ $driver->address }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Driver</button>
    </form>
@endsection
