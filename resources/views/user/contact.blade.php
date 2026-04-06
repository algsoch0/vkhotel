@extends('layouts.app')

@section('title', 'Contact Us - VK Hotel')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1 data-aos="fade-up">Contact Us</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-right">
                <div class="section-title text-start">
                    <span class="subtitle">Get in Touch</span>
                    <h2>We'd Love to Hear From You</h2>
                    <div class="divider" style="margin-left: 0;"></div>
                </div>
                <p class="mb-4">Have questions about bookings, special events, or anything else? Our team is here to help you 24/7.</p>

                <div class="d-flex mb-4">
                    <div class="bg-gold rounded-circle p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                    </div>
                    <div>
                        <h5>Visit Us</h5>
                        <p class="mb-0">123 Hotel Street, Luxury City<br>NY 10001, United States</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="bg-gold rounded-circle p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-phone-alt fa-2x text-white"></i>
                    </div>
                    <div>
                        <h5>Call Us</h5>
                        <p class="mb-0">+1 (234) 567-890<br>+1 (234) 567-891</p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="bg-gold rounded-circle p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-envelope fa-2x text-white"></i>
                    </div>
                    <div>
                        <h5>Email Us</h5>
                        <p class="mb-0">info@vkhotel.com<br>reservations@vkhotel.com</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h4 class="mb-4">Send us a Message</h4>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="subject" name="subject">
                                            <option value="general">General Inquiry</option>
                                            <option value="booking">Booking Question</option>
                                            <option value="events">Events & Weddings</option>
                                            <option value="feedback">Feedback</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" style="height: 150px" placeholder="Your Message" required></textarea>
                                        <label for="message">Your Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-gold btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1645564567075!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection