@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center">Our Rooms</h1>
            <p class="text-center">Choose from our selection of luxurious rooms</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.rooms.index') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="type" class="form-label">Room Type</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">All Types</option>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <select name="capacity" id="capacity" class="form-select">
                                <option value="">Any</option>
                                <option value="1" {{ request('capacity') == '1' ? 'selected' : '' }}>1 Person</option>
                                <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2 Persons</option>
                                <option value="3" {{ request('capacity') == '3' ? 'selected' : '' }}>3 Persons</option>
                                <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ Persons</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input type="number" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="$">
                        </div>
                        <div class="col-md-2">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input type="number" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="$">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Rooms Grid -->
    <div class="row">
        @forelse($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($room->image)
                    <img src="{{ asset($room->image) }}" class="card-img-top" alt="{{ $room->type }}" style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Room Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ ucfirst($room->type) }} Room - #{{ $room->room_number }}</h5>
                    <p class="card-text">{{ Str::limit($room->description, 100) }}</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-users"></i> Capacity: {{ $room->capacity }} persons</li>
                        <li><i class="fas fa-tag"></i> Price: ${{ number_format($room->price, 2) }}/night</li>
                        <li><i class="fas fa-star"></i> Status: 
                            @if($room->is_available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Not Available</span>
                            @endif
                        </li>
                    </ul>
                    <a href="{{ route('user.rooms.show', $room) }}" class="btn btn-primary w-100">View Details</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <div class="alert alert-info text-center">
                No rooms found matching your criteria.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-md-12">
            {{ $rooms->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection