@extends('layouts.app')

@section('title', ucfirst($room->type) . ' Room')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">{{ ucfirst($room->type) }} Room #{{ $room->room_number }}</h1>
        <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">Curated comfort for business and leisure stays.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                @php
                    $roomImage = $room->image ? asset($room->image) : 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1200&q=80';
                    $amenities = [];
                    if (is_array($room->amenities)) {
                        $amenities = $room->amenities;
                    } elseif (!empty($room->amenities)) {
                        $decoded = json_decode($room->amenities, true);
                        $amenities = is_array($decoded) ? $decoded : [];
                    }
                    if (empty($amenities)) {
                        $amenities = ['Premium WiFi', 'Rain Shower', 'Workspace', 'Smart TV', 'Breakfast Included', 'Concierge'];
                    }
                @endphp

                <div class="position-relative" data-aos="fade-up">
                    <img src="{{ $roomImage }}" alt="Room image" class="img-fluid rounded-4 shadow-sm w-100" style="height:460px;object-fit:cover;">
                    <span class="badge {{ $room->is_available ? 'text-bg-success' : 'text-bg-danger' }} position-absolute top-0 end-0 m-3 px-3 py-2">
                        {{ $room->is_available ? 'Available' : 'Unavailable' }}
                    </span>
                </div>

                <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4">
                        <h2 class="h4">Room Overview</h2>
                        <p class="text-muted mb-0">{{ $room->description ?: 'A premium room experience with thoughtful details, calming aesthetics, and signature VK Hotel service.' }}</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">Amenities</h3>
                        <div class="row g-2">
                            @foreach($amenities as $amenity)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-2 py-1">
                                        <i class="fas fa-circle-check" style="color:var(--primary-color);"></i>
                                        <span>{{ $amenity }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top:100px;" data-aos="fade-left">
                    <div class="card-body p-4">
                        <p class="small text-uppercase text-muted mb-1">From</p>
                        <p class="display-6 mb-0" style="color:var(--primary-color);">${{ number_format($room->price, 2) }}</p>
                        <p class="text-muted">per night</p>

                        <ul class="list-unstyled small mb-4">
                            <li class="mb-2"><i class="fas fa-users me-2"></i>Up to {{ $room->capacity }} guests</li>
                            <li class="mb-2"><i class="fas fa-door-open me-2"></i>{{ ucfirst($room->type) }} category</li>
                            <li><i class="fas fa-shield-halved me-2"></i>Secure booking and support</li>
                        </ul>

                        @auth
                            <div class="d-grid mb-3">
                                <a href="{{ route('user.bookings.create', ['room' => $room->id]) }}" class="btn btn-outline-dark">Open Booking Summary</a>
                            </div>
                            <form id="bookingForm" action="{{ route('user.bookings.store') }}" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Check In</label>
                                    <input type="date" class="form-control" name="check_in_date" id="check_in" min="{{ now()->toDateString() }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Check Out</label>
                                    <input type="date" class="form-control" name="check_out_date" id="check_out" min="{{ now()->addDay()->toDateString() }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Guests</label>
                                    <select name="guests" class="form-select" required>
                                        @for($i = 1; $i <= $room->capacity; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Guest' : 'Guests' }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Special Requests</label>
                                    <textarea class="form-control" rows="3" name="special_requests" placeholder="Airport pickup, late check-in, dietary preferences..."></textarea>
                                </div>
                                <div class="col-12" id="priceDisplay" style="display:none;">
                                    <div class="alert alert-info mb-0">
                                        <strong>Total:</strong> $<span id="totalPrice">0.00</span>
                                        <div class="small mt-1" id="nightsDisplay"></div>
                                    </div>
                                </div>
                                <div class="col-12 d-grid">
                                    <button class="btn btn-gold" type="submit">Reserve This Room</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning">Sign in to continue booking this room.</div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('login') }}" class="btn btn-gold">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-dark">Create Account</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedRooms->isNotEmpty())
<section class="py-5" style="background:#f7f8fb;">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>You May Also Like</h2>
            <div class="divider"></div>
        </div>
        <div class="row g-4">
            @foreach($relatedRooms as $item)
                @php
                    $relatedImage = $item->image ? asset($item->image) : 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80';
                @endphp
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ $relatedImage }}" alt="Related room" class="card-img-top" style="height:220px;object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <h3 class="h5">{{ ucfirst($item->type) }} Room</h3>
                            <p class="text-muted small">Capacity: {{ $item->capacity }} guests</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <strong style="color:var(--primary-color);">${{ number_format($item->price, 2) }}</strong>
                                <a href="{{ route('user.rooms.show', $item) }}" class="btn btn-dark btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
$(document).ready(function() {
    // Calculate total price
    function calculatePrice() {
        const checkIn = $('#check_in').val();
        const checkOut = $('#check_out').val();
        
        if (checkIn && checkOut) {
            $.ajax({
                url: '{{ route("user.rooms.check-availability", $room) }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    check_in: checkIn,
                    check_out: checkOut,
                    guests: $('select[name="guests"]').val()
                },
                success: function(response) {
                    if (response.available) {
                        $('#priceDisplay').show();
                        $('#totalPrice').text(response.total_price.toFixed(2));
                        $('#nightsDisplay').text(response.nights + ' night' + (response.nights > 1 ? 's' : ''));
                        $('#bookingForm button[type="submit"]').prop('disabled', false);
                    } else {
                        $('#priceDisplay').hide();
                        $('#bookingForm button[type="submit"]').prop('disabled', true);

                        Swal.fire({
                            icon: 'error',
                            title: 'Not Available',
                            text: response.message,
                            confirmButtonColor: 'var(--primary-color)'
                        });
                    }
                }
            });
        }
    }

    $('#check_in, #check_out, select[name="guests"]').change(calculatePrice);

    // Form submission
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Confirm Booking',
            text: 'Are you sure you want to proceed with this booking?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--primary-color)',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, book now!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endpush
@endsection