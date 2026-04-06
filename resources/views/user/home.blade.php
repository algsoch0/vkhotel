@extends('layouts.app')

@section('title', 'Luxury Redefined - VK Hotel')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 data-aos="fade-up">Welcome to VK Hotel</h1>
            <p data-aos="fade-up" data-aos-delay="200">Experience unparalleled luxury and comfort in the heart of the city. Where every moment becomes a cherished memory.</p>
            <div class="btn-group" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('user.rooms.index') }}" class="btn btn-gold me-3">Explore Rooms</a>
                <a href="#booking" class="btn btn-outline-gold">Book Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section id="booking" class="container" style="margin-top: -80px; position: relative; z-index: 10;">
    <div class="booking-form" data-aos="fade-up">
        <form action="{{ route('user.rooms.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label>Check In</label>
                    <input type="date" name="check_in" class="form-control" min="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label>Check Out</label>
                    <input type="date" name="check_out" class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
                <div class="col-md-2">
                    <label>Guests</label>
                    <select name="guests" class="form-select">
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Room Type</label>
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="suite">Suite</option>
                        <option value="deluxe">Deluxe</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-gold w-100">Check Availability</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Welcome Section -->
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="section-title text-start">
                    <span class="subtitle">Welcome to Luxury</span>
                    <h2>Experience the Finest Hospitality</h2>
                    <div class="divider" style="margin-left: 0;"></div>
                </div>
                <p class="mb-4">Nestled in the heart of the city, VK Hotel offers a perfect blend of modern luxury and traditional warmth. Our award-winning service and world-class amenities ensure an unforgettable stay.</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-check-circle text-gold fs-2 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h5>Luxury Rooms</h5>
                                <p>Elegantly designed rooms with premium amenities</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="fas fa-concierge-bell text-gold fs-2 me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h5>24/7 Service</h5>
                                <p>Round-the-clock room service and concierge</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn btn-gold mt-4">Learn More About Us</a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="img-fluid rounded-3" alt="Hotel Image">
                    </div>
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="img-fluid rounded-3 mb-3" alt="Hotel Image">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d5773340b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80" class="img-fluid rounded-3" alt="Hotel Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle">Luxury Accommodations</span>
            <h2>Our Featured Rooms</h2>
            <div class="divider"></div>
            <p class="mt-3">Discover our carefully curated selection of luxurious rooms and suites</p>
        </div>

        <div class="row">
            @forelse($featuredRooms as $room)
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card">
                    <div class="position-relative overflow-hidden">
                        @if($room->image)
                            <img src="{{ asset($room->image) }}" class="card-img-top" alt="{{ $room->type }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="card-img-top" alt="Room Image">
                        @endif
                        <span class="position-absolute top-0 end-0 bg-gold text-white px-3 py-2 m-3 rounded-pill" style="background: var(--primary-color);">
                            <i class="fas fa-star me-1"></i> Featured
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">{{ ucfirst($room->type) }} Suite</h5>
                            <span class="room-price">${{ number_format($room->price, 2) }}<small>/night</small></span>
                        </div>
                        <p class="card-text text-muted">{{ Str::limit($room->description, 100) }}</p>
                        
                        <div class="mb-3">
                            <span class="amenities-badge"><i class="fas fa-users"></i> {{ $room->capacity }} Guests</span>
                            <span class="amenities-badge"><i class="fas fa-bed"></i> King Bed</span>
                            <span class="amenities-badge"><i class="fas fa-wifi"></i> WiFi</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="text-muted ms-1">(4.5)</span>
                            </div>
                            <a href="{{ route('user.rooms.show', $room) }}" class="btn btn-gold">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> No rooms available at the moment.
                </div>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-gold">View All Rooms</a>
        </div>
    </div>
</section>

<!-- Amenities Section -->
<section class="py-5" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-attachment: fixed; background-size: cover;">
    <div class="container">
        <div class="section-title text-white" data-aos="fade-up">
            <span class="subtitle">World-Class Facilities</span>
            <h2 class="text-white">Luxury Amenities</h2>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center text-white">
                    <div class="bg-gold rounded-circle d-inline-flex p-4 mb-3" style="background: var(--primary-color);">
                        <i class="fas fa-swimmer fa-3x"></i>
                    </div>
                    <h5>Infinity Pool</h5>
                    <p class="text-white-50">Overlooking the city skyline</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center text-white">
                    <div class="bg-gold rounded-circle d-inline-flex p-4 mb-3" style="background: var(--primary-color);">
                        <i class="fas fa-dumbbell fa-3x"></i>
                    </div>
                    <h5>Fitness Center</h5>
                    <p class="text-white-50">State-of-the-art equipment</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center text-white">
                    <div class="bg-gold rounded-circle d-inline-flex p-4 mb-3" style="background: var(--primary-color);">
                        <i class="fas fa-spa fa-3x"></i>
                    </div>
                    <h5>Luxury Spa</h5>
                    <p class="text-white-50">Rejuvenate your senses</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center text-white">
                    <div class="bg-gold rounded-circle d-inline-flex p-4 mb-3" style="background: var(--primary-color);">
                        <i class="fas fa-utensils fa-3x"></i>
                    </div>
                    <h5>Fine Dining</h5>
                    <p class="text-white-50">Michelin-starred restaurant</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle">Guest Reviews</span>
            <h2>What Our Guests Say</h2>
            <div class="divider"></div>
        </div>

        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1494790108777-466d7e8bdfe1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" alt="Guest">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic">"Absolutely wonderful experience! The staff went above and beyond to make our stay special. The room was immaculate and the view was breathtaking."</p>
                        <h5 class="mb-0">Sarah Johnson</h5>
                        <small class="text-muted">Business Traveler</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" alt="Guest">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic">"The best hotel I've ever stayed at! The attention to detail is incredible. The spa treatments were amazing and the food was delicious."</p>
                        <h5 class="mb-0">Michael Chen</h5>
                        <small class="text-muted">Vacationer</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" alt="Guest">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="fst-italic">"Perfect location, luxurious rooms, and exceptional service. The concierge helped us plan our entire trip. Will definitely come back!"</p>
                        <h5 class="mb-0">Emily Rodriguez</h5>
                        <small class="text-muted">Honeymooner</small>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Gallery Preview -->
<section class="py-5" style="background: var(--light-bg);">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle">Instagram Moments</span>
            <h2>Hotel Gallery</h2>
            <div class="divider"></div>
        </div>

        <div class="row g-3">
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Gallery">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Gallery">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1932&q=80" alt="Gallery">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Gallery">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('gallery') }}" class="btn btn-gold">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, #b38f3c 100%);">
    <div class="container text-center text-white">
        <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Ready for a Luxurious Stay?</h2>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Book your room now and enjoy exclusive discounts</p>
        <a href="{{ route('user.rooms.index') }}" class="btn btn-light btn-lg px-5" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-calendar-check me-2"></i> Book Your Stay
        </a>
    </div>
</section>

<!-- Newsletter -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h3 data-aos="fade-up">Subscribe to Our Newsletter</h3>
                <p class="text-muted mb-4" data-aos="fade-up" data-aos-delay="100">Get exclusive offers and updates about our hotel</p>
                <form class="row g-3 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-8">
                        <input type="email" class="form-control form-control-lg" placeholder="Your Email Address">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-gold btn-lg">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection