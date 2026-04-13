@extends('layouts.app')

@section('title', 'Confirm Booking')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Confirm Your Stay</h1>
        <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">Review booking details before placing your reservation.</p>
    </div>
</section>

<section class="py-5" style="background:#f7f8fb;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">Reservation Details</h2>
                        <form action="{{ route('user.bookings.store') }}" method="POST" class="row g-3">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="check_in_date" value="{{ $bookingData['check_in'] }}">
                            <input type="hidden" name="check_out_date" value="{{ $bookingData['check_out'] }}">
                            <input type="hidden" name="guests" value="{{ $bookingData['guests'] }}">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Check In</label>
                                <input class="form-control" value="{{ \Carbon\Carbon::parse($bookingData['check_in'])->format('D, d M Y') }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Check Out</label>
                                <input class="form-control" value="{{ \Carbon\Carbon::parse($bookingData['check_out'])->format('D, d M Y') }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Guests</label>
                                <input class="form-control" value="{{ $bookingData['guests'] }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nights</label>
                                <input class="form-control" value="{{ $nights }}" disabled>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Special Requests</label>
                                <textarea name="special_requests" rows="4" class="form-control" placeholder="Late check-in, airport pickup, food preferences...">{{ old('special_requests') }}</textarea>
                            </div>
                            <div class="col-12 d-flex gap-2 justify-content-end">
                                <a href="{{ route('user.rooms.show', $room) }}" class="btn btn-outline-secondary">Back</a>
                                <button type="submit" class="btn btn-gold">Place Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" data-aos="fade-left">
                    <div class="card-body p-4">
                        <h3 class="h6 text-uppercase text-muted">Price Breakdown</h3>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Room rate</span>
                            <strong>${{ number_format($room->price, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Nights</span>
                            <strong>{{ $nights }}</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h6 mb-0">Total</span>
                            <span class="h5 mb-0" style="color:var(--primary-color);">${{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
