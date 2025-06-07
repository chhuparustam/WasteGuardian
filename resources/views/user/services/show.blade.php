@extends('user.layout')

@section('content')
<div class="service-details">
    <h2>{{ $service['name'] }}</h2>
    <img src="{{ asset($service['image']) }}" alt="{{ $service['name'] }}" class="details-image">
    <div class="details-info">
        <p><strong>Duration:</strong> {{ $service['duration'] }}</p>
        <p><strong>Frequency:</strong> {{ $service['frequency'] }}</p>
        <p><strong>Price:</strong> Rs. {{ $service['price'] }}</p>
        <p>{{ $service['description'] }}</p>
    </div>
    <form action="{{ route('services.book', ['service' => $service['slug']]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
@endsection