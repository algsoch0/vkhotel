@extends('layouts.app')

@section('title', $room->type . ' Room - VK Hotel')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">{{ ucfirst($room->type) }} Suite</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.rooms.index') }}">Rooms</a></li>
                <li class="breadcrumb-item active">{{ $room->type }} Room</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Room Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Room Images -->
                <div class="position-relative mb-4" data-aos="fade-up">
                    @if($room->image)
                        <img src="{{ asset($room->image) }}" class="img-fluid rounded-3 w-100" alt="{{ $room->type }}" style="max-height: 500px; object-fit: cover;">
                    @else
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="img-fluid rounded-3 w-100" alt="Room Image">
                    @endif
                    @if($room->is_available)
                        <span class="position-absolute top-0 end-0 bg-success text-white px-4 py-2 m-3 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Available
                        </span>
                    @else
                        <span class="position-absolute top-0 end-0 bg-danger text-white px-4 py-2 m-3 rounded-pill">
                            <i class="fas fa-times-circle me-1"></i> Not Available
                        </span>
                    @endif
                </div>

                <!-- Room Information -->
                <div class="mb-4" data-aos="fade-up">
                    <h2>Room Overview</h2>
                    <p>{{ $room->description }}</p>
                </div>

                <!-- Amenities -->
                <div class="mb-4" data-aos="fade-up">
                    <h3>Amenities</h3>
                    <div class="row g-3 mt-2">
                        @php
                            $amenities = $room->amenities ? json_decode($room->amenities) : [
                                'Free WiFi', 'Air Conditioning', 'Mini Bar', 'Room Service', 
                                'Flat Screen TV', 'Coffee Maker', 'Hair Dryer', 'Safe Deposit Box'
                            ];
                        @endphp
                        
                        @foreach($amenities as $amenity)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>{{ $amenity }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Room Features -->
                <div class="mb-4" data-aos="fade-up">
                    <h3>Room Features</h3>
                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <div class="card bg-light border-0 p-3 text-center">
                                <i class="fas fa-arrows-alt fs-2 mb-2" style="color: var(--primary-color);"></i>
                                <h6>Room Size</h6>
                                <p class="mb-0">45 m²</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 p-3 text-center">
                                <i class="fas fa-bed fs-2 mb-2" style="color: var(--primary-color);"></i>
                                <h6>Bed Type</h6>
                                <p class="mb-0">King Size</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 p-3 text-center">
                                <i class="fas fa-users fs-2 mb-2" style="color: var(--primary-color);"></i>
                                <h6>Capacity</h6>
                                <p class="mb-0">{{ $room->capacity }} Guests</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="mb-4" data-aos="fade-up">
                    <h3>Guest Reviews</h3>
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning fs-4 me-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="h4 mb-0">4.5</span>
                        <span class="text-muted ms-2">(120 reviews)</span>
                    </div>

                    <div class="review-list">
                        <div class="d-flex mb-4">
                            <img src="https://images.unsplash.com/photo-1494790108777-466d7e8bdfe1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" class="rounded-circle me-3" width="60" height="60" alt="User">
                            <div>
                                <h6 class="mb-1">Sarah Johnson</h6>
                                <div class="text-warning small mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0">Amazing room with a spectacular view! The amenities were top-notch.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" class="rounded-circle me-3" width="60" height="60" alt="User">
                            <div>
                                <h6 class="mb-1">Michael Chen</h6>
                                <div class="text-warning small mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="mb-0">Very comfortable and clean. The staff was extremely helpful.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Booking Card -->
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;" data-aos="fade-left">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Book This Room</h4>
                        <div class="room-price mb-4">
                            <span class="display-6">${{ number_format($room->price, 2) }}</span>
                            <span class="text-muted">/night</span>
                        </div>

                        @auth
                            <form id="bookingForm" action="{{ route('user.bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                
                                <div class="mb-3">
                                    <label class="form-label">Check In Date</label>
                                    <input type="date" name="check_in_date" class="form-control form-control-lg" 
                                           min="{{ date('Y-m-d') }}" required id="check_in">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Check Out Date</label>
                                    <input type="date" name="check_out_date" class="form-control form-control-lg" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required id="check_out">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Number of Guests</label>
                                    <select name="guests" class="form-select form-select-lg" required>
                                        @for($i = 1; $i <= $room->capacity; $i++)
                                            <option value="{{ $i }}">{{ $i }} {{ $i > 1 ? 'Guests' : 'Guest' }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-4" id="priceDisplay" style="display: none;">
                                    <div class="alert alert-info">
                                        <strong>Total Price:</strong> $<span id="totalPrice">0.00</span>
                                        <br>
                                        <small class="text-muted" id="nightsDisplay"></small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 btn-lg mb-3">
                                    <i class="fas fa-calendar-check me-2"></i> Book Now
                                </button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Please <a href="{{ route('login') }}" class="alert-link">login</a> to book this room.
                            </div>
                            <a href="{{ route('login') }}" class="btn btn-gold w-100 btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i> Login to Book
                            </a>
                        @endauth

                        <hr class="my-4">

                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt fs-3 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="mb-1">Secure Booking</h6>
                                <p class="small text-muted mb-0">Your information is safe with us</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-3">
                            <i class="fas fa-clock fs-3 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h6 class="mb-1">Free Cancellation</h6>
                                <p class="small text-muted mb-0">Up to 24 hours before check-in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Rooms -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Similar Rooms You Might Like</h2>
            <div class="divider"></div>
        </div>

        <div class="row">
            @foreach(range(1, 3) as $index)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="card-img-top" alt="Room">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($room->type) }} Suite</h5>
                        <p class="room-price mb-3">${{ number_format($room->price, 2) }}<small>/night</small></p>
                        <a href="#" class="btn btn-outline-gold w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

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