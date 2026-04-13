@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Reservation {{ $booking->confirmation_code ?: 'BK-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</h1>
        <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">Your full booking summary and status.</p>
    </div>
</section>

<section class="py-5" style="background:#f7f8fb;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Stay Details</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Room</p>
                                <p class="fw-semibold mb-0">{{ ucfirst($booking->room->type) }} Room #{{ $booking->room->room_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Status</p>
                                @php
                                    $statusClass = match($booking->status) {
                                        'confirmed' => 'text-bg-success',
                                        'cancelled' => 'text-bg-danger',
                                        'completed' => 'text-bg-primary',
                                        default => 'text-bg-warning'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Check In</p>
                                <p class="fw-semibold mb-0">{{ $booking->check_in_date->format('D, d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Check Out</p>
                                <p class="fw-semibold mb-0">{{ $booking->check_out_date->format('D, d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Guests</p>
                                <p class="fw-semibold mb-0">{{ $booking->guests }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Total Price</p>
                                <p class="fw-semibold mb-0">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                            <div class="col-12">
                                <p class="small text-muted mb-1">Special Requests</p>
                                <p class="mb-0">{{ $booking->special_requests ?: 'No special requests provided.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" data-aos="fade-left">
                    <div class="card-body p-4">
                        <h3 class="h6 text-uppercase text-muted">Actions</h3>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-dark">Back to My Bookings</a>
                            <a href="{{ route('user.rooms.index') }}" class="btn btn-dark">Book Another Room</a>
                            @if(in_array($booking->status, ['pending', 'confirmed']))
                                <form method="POST" action="{{ route('user.bookings.cancel', $booking) }}" onsubmit="return confirm('Cancel this booking?');">
                                    @csrf
                                    <button class="btn btn-outline-danger w-100" type="submit">Cancel Booking</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
