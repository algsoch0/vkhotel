@extends('layouts.app')

@section('title', 'About Us - VK Hotel')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">About VK Hotel</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">About</li>
            </ol>
        </nav>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="section-title text-start">
                    <span class="subtitle">Our Story</span>
                    <h2>A Legacy of Luxury Since 1995</h2>
                    <div class="divider" style="margin-left: 0;"></div>
                </div>
                <p class="lead">Welcome to VK Hotel, where timeless elegance meets modern luxury.</p>
                <p>Founded in 1995, VK Hotel has been a beacon of hospitality excellence in the heart of the city. Our commitment to providing unparalleled service and creating memorable experiences has made us a preferred choice for discerning travelers from around the world.</p>
                <p>Over the years, we have continuously evolved while maintaining our core values of hospitality, integrity, and excellence. Each of our 200+ rooms and suites is thoughtfully designed to provide the perfect blend of comfort and sophistication.</p>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="d-flex">
                            <i class="fas fa-trophy fa-3x me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h4 class="mb-0">25+</h4>
                                <p class="text-muted">Awards Won</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex">
                            <i class="fas fa-smile fa-3x me-3" style="color: var(--primary-color);"></i>
                            <div>
                                <h4 class="mb-0">50k+</h4>
                                <p class="text-muted">Happy Guests</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" class="img-fluid rounded-3" alt="Hotel">
                    <div class="position-absolute bottom-0 end-0 bg-gold text-white p-4 rounded-3 m-4" style="max-width: 200px;">
                        <h3 class="h2 mb-0">25</h3>
                        <p class="mb-0">Years of Excellence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle">Our Core Values</span>
            <h2>What Drives Us</h2>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-gold rounded-circle d-inline-flex p-3 mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-heart fa-2x text-white"></i>
                    </div>
                    <h4>Passion</h4>
                    <p class="text-muted">We pour our hearts into every aspect of your stay, ensuring every moment is special.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-gold rounded-circle d-inline-flex p-3 mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-hand-holding-heart fa-2x text-white"></i>
                    </div>
                    <h4>Excellence</h4>
                    <p class="text-muted">We strive for perfection in service, amenities, and guest satisfaction.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="bg-gold rounded-circle d-inline-flex p-3 mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-leaf fa-2x text-white"></i>
                    </div>
                    <h4>Sustainability</h4>
                    <p class="text-muted">We're committed to eco-friendly practices and responsible tourism.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span class="subtitle">Meet Our Team</span>
            <h2>The Faces Behind VK Hotel</h2>
            <div class="divider"></div>
        </div>

        <div class="row">
            @php
                $team = [
                    ['name' => 'John Doe', 'position' => 'General Manager', 'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a'],
                    ['name' => 'Jane Smith', 'position' => 'Head of Operations', 'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e'],
                    ['name' => 'Mike Johnson', 'position' => 'Executive Chef', 'image' => 'https://images.unsplash.com/photo-1581299894007-aaa50297cf16'],
                    ['name' => 'Sarah Williams', 'position' => 'Guest Relations', 'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956'],
                ];
            @endphp

            @foreach($team as $index => $member)
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card border-0 shadow-sm text-center">
                    <img src="{{ $member['image'] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="{{ $member['name'] }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $member['name'] }}</h5>
                        <p class="text-gold mb-2">{{ $member['position'] }}</p>
                        <div class="social-links">
                            <a href="#" class="bg-gold"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="bg-gold"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="bg-gold"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection