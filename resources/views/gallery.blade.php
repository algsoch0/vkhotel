@extends('layouts.app')

@section('title', 'Gallery - VK Hotel')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Hotel Gallery</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Gallery</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @php
                $images = [
                    ['url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945', 'title' => 'Hotel Exterior'],
                    ['url' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b', 'title' => 'Luxury Lobby'],
                    ['url' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39', 'title' => 'Deluxe Room'],
                    ['url' => 'https://images.unsplash.com/photo-1590490360182-c33d5773340b', 'title' => 'Restaurant'],
                    ['url' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6', 'title' => 'Infinity Pool'],
                    ['url' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7', 'title' => 'Spa'],
                    ['url' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791', 'title' => 'Gym'],
                    ['url' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461', 'title' => 'Conference Hall'],
                    ['url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb', 'title' => 'Rooftop Bar'],
                    ['url' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304', 'title' => 'Presidential Suite'],
                    ['url' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd', 'title' => 'Bathroom'],
                    ['url' => 'https://images.unsplash.com/photo-1584132915807-fd1f5fbc078f', 'title' => 'Garden'],
                ];
            @endphp

            @foreach($images as $index => $image)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                <div class="gallery-item">
                    <img src="{{ $image['url'] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid" alt="{{ $image['title'] }}">
                    <div class="gallery-overlay">
                        <div class="text-center text-white">
                            <i class="fas fa-camera fa-3x mb-3"></i>
                            <h5>{{ $image['title'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection