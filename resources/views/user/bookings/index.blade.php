@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">My Bookings</h1>
        <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">Track all your stays and reservation history in one place.</p>
    </div>
</section>

<section class="py-5" style="background:#f7f8fb;">
    <div class="container">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Total</p>
                        <h3 class="mb-0">{{ $bookings->total() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Pending</p>
                        <h3 class="mb-0">{{ $bookings->where('status', 'pending')->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Confirmed</p>
                        <h3 class="mb-0">{{ $bookings->where('status', 'confirmed')->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted small mb-1">Cancelled</p>
                        <h3 class="mb-0">{{ $bookings->where('status', 'cancelled')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($bookings->count())
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">Reservation</th>
                                    <th>Room</th>
                                    <th>Dates</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="text-end px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-semibold">{{ $booking->confirmation_code ?: 'BK-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
                                            <small class="text-muted">Booked {{ $booking->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ ucfirst($booking->room->type) }} Room</div>
                                            <small class="text-muted">#{{ $booking->room->room_number }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $booking->check_in_date->format('M d, Y') }}</div>
                                            <small class="text-muted">to {{ $booking->check_out_date->format('M d, Y') }}</small>
                                        </td>
                                        <td class="fw-semibold">${{ number_format($booking->total_price, 2) }}</td>
                                        <td>
                                            @php
                                                $statusClass = match($booking->status) {
                                                    'confirmed' => 'text-bg-success',
                                                    'cancelled' => 'text-bg-danger',
                                                    'completed' => 'text-bg-primary',
                                                    default => 'text-bg-warning'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                                        </td>
                                        <td class="text-end px-4">
                                            <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-sm btn-dark">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-5 text-center">
                        <h3 class="h5">No bookings yet</h3>
                        <p class="text-muted">Start by exploring our rooms and reserve your first stay.</p>
                        <a href="{{ route('user.rooms.index') }}" class="btn btn-gold">Browse Rooms</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</section>
@endsection
