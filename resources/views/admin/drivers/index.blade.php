@extends('admin.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage Drivers</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.drivers.create') }}" class="btn btn-sm btn-primary">+ Add Driver</a>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-table me-1"></i> Driver List</span>
            
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Driver Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
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
                                <!-- Edit Button -->
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Delete Button with Confirmation -->
                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
</div>
@endsection
