@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/my-reequests.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
<div class="latest-requests-section">
    <h2><i class="fas fa-recycle"></i> My Requests</h2>

     @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

         @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-check-circle"></i>
                {{ session('error') }}
            </div>
        @endif
    @if($requests->count())
        <table class="table latest-requests-table">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Landmark</th>
                    <th>Waste Photo</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->address }}</td>
                        <td>{{ $request->landmark ?? '-' }}</td>
                        <td>
                            @if($request->photo)
                                <img src="{{ asset('storage/' . $request->photo) }}" alt="Waste Photo" style="max-width:80px;max-height:80px;border-radius:8px;">
                            @else
                                <span style="color:#aaa;">No Photo</span>
                            @endif
                        </td>
                         <td>{{ $request->message }}</td>
                        <td>
                            <span class="status status-{{ strtolower($request->status) }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td>{{ $request->created_at->format('d M Y, h:i A') }}</td>
                        <td><a href='{{ route("user.my-requests-edit",$request->id)}}'> Edit </a>| <a href='{{ route("user.my-requests-delete", $request->id)}}'> Delete </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-requests">No recent requests found.</p>
    @endif
</div>
@endsection