@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/my-reequests.css') }}">
<div class="latest-requests-section">
    <h2><i class="fas fa-recycle"></i> My Requests</h2>
    @if($requests->count())
        <table class="table latest-requests-table">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Landmark</th>
                    <th>Waste Photo</th>
                    <th>Status</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->address }}</td>
                        <td>{{ $request->landmark ?? '-' }}</td>
                        <td>
                            @if($request->photo)
                                <img src="{{ asset('storage/requests/' . $request->photo) }}" alt="Waste Photo" style="max-width:80px;max-height:80px;border-radius:8px;">
                            @else
                                <span style="color:#aaa;">No Photo</span>
                            @endif
                        </td>
                        <td>
                            <span class="status status-{{ strtolower($request->status) }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td>{{ $request->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-requests">No recent requests found.</p>
    @endif
</div>
@endsection