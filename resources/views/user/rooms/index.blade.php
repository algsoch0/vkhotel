@extends('layouts.app')

@section('title', 'Find Your Stay')

@section('content')
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Find Your Perfect Room</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">Search by budget, dates, guest count, and room type.</p>
    </div>
</section>

<section class="py-5" style="background:#f7f8fb;">
    <div class="container">
        <div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
            <div class="card-body p-4">
                <form action="{{ route('user.rooms.index') }}" method="GET" class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Type</label>
                        <select name="type" class="form-select">
                            <option value="">Any</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Guests</label>
                        <input type="number" name="guests" min="1" class="form-control" value="{{ request('guests') }}" placeholder="2">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Check In</label>
                        <input type="date" name="check_in" min="{{ now()->toDateString() }}" class="form-control" value="{{ request('check_in') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Check Out</label>
                        <input type="date" name="check_out" min="{{ now()->addDay()->toDateString() }}" class="form-control" value="{{ request('check_out') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Min / Max</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="min_price" min="0" class="form-control" placeholder="0" value="{{ request('min_price') }}">
                            <input type="number" name="max_price" min="0" class="form-control" placeholder="700" value="{{ request('max_price') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Sort</label>
                        <select name="sort" class="form-select">
                            <option value="latest" @selected(request('sort') === 'latest')>Newest</option>
                            <option value="price_low" @selected(request('sort') === 'price_low')>Price: Low</option>
                            <option value="price_high" @selected(request('sort') === 'price_high')>Price: High</option>
                            <option value="popular" @selected(request('sort') === 'popular')>Most Booked</option>
                        </select>
                    </div>
                    <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
                        <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-secondary">Reset</a>
                        <button class="btn btn-gold" type="submit">Search Rooms</button>
                    </div>
                </form>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix these filters:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">{{ $rooms->total() }} room(s) found</h2>
            <span class="text-muted">Page {{ $rooms->currentPage() }} of {{ $rooms->lastPage() }}</span>
        </div>

        <div class="row g-4">
            @forelse($rooms as $room)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <article class="card border-0 shadow-sm h-100">
                        @php
                            $image = $room->image ? asset($room->image) : 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1200&q=80';
                        @endphp
                        <img src="{{ $image }}" class="card-img-top" style="height:220px;object-fit:cover;" alt="{{ $room->type }} room">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <h3 class="h5 mb-0">{{ ucfirst($room->type) }} Room</h3>
                                <span class="badge bg-light text-dark">#{{ $room->room_number }}</span>
                            </div>
                            <p class="text-muted small">{{ \Illuminate\Support\Str::limit($room->description ?: 'Comfort-focused room with curated amenities and concierge support.', 110) }}</p>
                            <div class="d-flex flex-wrap gap-2 mb-3 small">
                                <span class="badge rounded-pill text-bg-light"><i class="fas fa-users me-1"></i>{{ $room->capacity }} Guests</span>
                                <span class="badge rounded-pill text-bg-light"><i class="fas fa-door-open me-1"></i>{{ ucfirst($room->type) }}</span>
                                @if($room->is_available)
                                    <span class="badge rounded-pill text-bg-success">Available</span>
                                @endif
                            </div>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 h5" style="color:var(--primary-color);">${{ number_format($room->price, 2) }}</p>
                                    <small class="text-muted">per night</small>
                                </div>
                                <a href="{{ route('user.rooms.show', $room) }}" class="btn btn-dark">View Room</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <h3 class="h5">No rooms matched your filters.</h3>
                            <p class="text-muted mb-3">Try broadening your date or budget range.</p>
                            <a href="{{ route('user.rooms.index') }}" class="btn btn-gold">Show All Rooms</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $rooms->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection