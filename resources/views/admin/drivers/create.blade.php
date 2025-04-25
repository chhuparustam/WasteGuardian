    <!-- resources/views/admin/drivers/create.blade.php -->
    @extends('admin.layout')

    @section('content')
        <h1>Add Driver</h1>
        <form action="{{ route('admin.drivers.store') }}" method="POST">

            @csrf
            <div class="form-group">
                <label for="name">Driver's Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Driver</button>
        </form>
    @endsection
