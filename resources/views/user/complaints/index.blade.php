@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/my-complaints.css') }}">

<div class="complaints-container">
    <div class="complaints-header">
        <h2><i class="fas fa-list"></i> My Complaints</h2>
        <a href="{{ route('user.complaints.create') }}" class="new-complaint-btn">
            <i class="fas fa-plus"></i> New Complaint
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($complaints->isEmpty())
        <div class="no-complaints">
            <i class="fas fa-inbox"></i>
            <p>No complaints found</p>
            <small>Your submitted complaints will appear here</small>
        </div>
    @else
        <div class="table-responsive">
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $index => $complaint)
                    <tr>
                        <td class="id-column">{{ $index + 1 }}</td>
                        <td class="subject-column">{{ $complaint->subject }}</td>
                        <td class="description-column">
                            {{ \Illuminate\Support\Str::limit($complaint->description, 50) }}
                        </td>
                        <td class="status-column">
                            <span class="badge status-{{ $complaint->status ?? 'pending' }}">
                                {{ ucfirst($complaint->status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="date-column">
                            {{ $complaint->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
