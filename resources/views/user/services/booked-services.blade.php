@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/my-complaints.css') }}">

<div class="complaints-container">
    <div class="complaints-header">
        <h2><i class="fas fa-list"></i> My Booked Services</h2>
    
    </div>

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

    @if($bookings->isEmpty())
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $index => $booking)
                    <tr>
                        <td class="id-column">{{ $index + 1 }}</td>
                        <td class="subject-column">{{ $booking->cleaningService->title }}</td>
                        <td class="description-column">
                            {{ \Illuminate\Support\Str::limit($booking->cleaningService->description, 50) }}
                        </td>
                        <td class="status-column">
                            <span class="badge status-{{ $booking->status ?? 'pending' }}">
                                {{ ucfirst($booking->amount ?? '0') }}
                            </span>
                        </td>
                        <td class="date-column">
                            {{ $booking->cleaningService->duration ?? 0 }}
                        </td>
                        <td class="date-column">
                            {{ $booking->payment_status ?? 0 }}
                        </td>
                        <td class="date-column">
                            {{ $booking->status ?? 0 }}
                        </td>
                        @if($booking->status !='cancel')

                        <td>
                        @if($booking->payment_status !='Paid')    
                        <a href='{{ route("stripe.checkout", $booking->id)}}'>Pay </a>
                        @endif
                         |<a href='{{ route("user.services.booked.cancel", $booking->id)}}'>Cancel </a> </td>
                         @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
