@extends('layouts.app')

@section('content')
    <!-- Dynamic Banner -->
    <section class="dynamic-banner" id="dynamic-banner">
        <div class="banner-content">
            <div class="banner-text active" id="banner-text" data-banner-index="0">
                {{ __('New pet profiles feature now available') }}</div>
            <img src="{{ asset('assets/images/catBanner.png') }}" alt="Cat" class="banner-cat">
        </div>
    </section>

    <!-- Hero -->
    <section class="hero animate" id="home">
        <div class="hero-bg-element hero-bg-1"></div>
        <div class="hero-bg-element hero-bg-2"></div>
        <div class="hero-bg-element hero-bg-3"></div>
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title">{{ __('All Your Pet Needs in One App') }}</h1>
                <p class="hero-text">
                    {{ __('Complete pet care in your hands. Easily and quickly find everything using a single app.') }}</p>
                <div class="hero-buttons">
                    <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                        class="btn-primary" data-action="download-app">{{ __('Download App') }}</a>
                    <a href="#services" class="btn-outline"
                        data-action="scroll-to-services">{{ __('Explore Services') }}</a>
                </div>
            </div>
            <div class="image-stack">
                <div class="phone-1"><img src="{{ asset('assets/images/hero1.png') }}" alt="Screen 1"></div>
                <div class="phone-2"><img src="{{ asset('assets/images/hero3.png') }}" alt="Screen 2"></div>
                <div class="leo-mascot"><img src="{{ asset('assets/images/hero2.png') }}" alt="Mascot"></div>
            </div>
        </div>
    </section>

    <!-- Our Services -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Our Services') }}</h2>
                <p>{{ __('Everything you need for complete pet care in one app') }}</p>
            </div>

            <div class="services-grid">
                @foreach ($services as $service)
                    <div class="service-card animate" data-service="{{ $service->slug }}">
                        <div class="service-icon"><i class="{{ $service->icon }}"></i></div>
                        <h3>{{ $service->name }}</h3>
                        <a href="#{{ $service->slug }}" class="learn-more"
                            data-action="scroll-to-section">{{ __('Learn More') }} ></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PawApp Store Banner -->
    <section class="store-banner" id="store">
        <div class="container">
            <div class="store-banner-left">
                <div class="discount-badge">25% OFF</div>
                <img src="{{ asset('assets/images/store_banner3.png') }}" alt="Pet Product Left">
            </div>
            <div class="store-banner-center">
                <h3>{{ __('Visit the PawApp Store for exclusive offers!') }}</h3>
                <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank" class="visit-btn"
                    data-action="visit-store">{{ __('Visit Store') }}</a>
            </div>
            <div class="store-banner-right">
                <img src="{{ asset('assets/images/store_banner1.png') }}" alt="Pet Product Right 1">
                <img src="{{ asset('assets/images/store_banner2.png') }}" alt="Pet Product Right 2">
            </div>
        </div>
    </section>

    <!-- Store Info Section -->
    <section class="store-info-section">
        <div class="container">
            <div class="store-info-grid">
                <div class="info-box" data-info-type="location">
                    <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                    <h4>{{ __('Store Location') }}</h4>
                    <p>{{ __('123 Pet Street, Paw City') }}</p>
                </div>
                <div class="info-box" data-info-type="hours">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <h4>{{ __('Opening Hours') }}</h4>
                    <p>{{ __('Mon-Sun: 9AM - 9PM') }}</p>
                </div>
                <div class="info-box" data-info-type="contact">
                    <div class="icon"><i class="fas fa-phone"></i></div>
                    <h4>{{ __('Contact') }}</h4>
                    <p><a href="tel:+96541117003" class="phone-link">+965 4111 7003</a></p>
                </div>
                <div class="info-box" data-info-type="delivery">
                    <div class="icon"><i class="fas fa-truck"></i></div>
                    <h4>{{ __('Delivery') }}</h4>
                    <p>{{ __('Free delivery over $50') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Stores -->
    <section class="rec-stores">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Recommended Stores') }}</h2>
            </div>
            <div class="stores-grid">
                @foreach ($stores as $store)
                    <div class="store-card animate" data-store-id="{{ $store->id }}">
                        <div class="store-img">
                            <img src="{{ $store->image ? asset('storage/' . $store->image) : asset('assets/images/store1.png') }}"
                                alt="{{ $store->name }}">
                            @if ($store->logo)
                                <div class="store-logo"><img src="{{ asset('storage/' . $store->logo) }}" alt="Logo">
                                </div>
                            @endif
                        </div>
                        <div class="store-info">
                            <div class="store-name">{{ $store->name }} <span class="rating">★★★★★
                                    {{ $store->rating }}</span></div>
                            <div class="store-detail"><i class="fas fa-map-marker-alt"></i> {{ $store->location }}</div>
                            <div class="store-detail"><i class="fas fa-phone"></i> <a href="tel:{{ $store->phone }}"
                                    class="phone-link">{{ $store->phone }}</a></div>
                            <div class="store-detail"><i class="fas fa-clock"></i> {{ $store->working_hours }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recommended Clinics -->
    <section class="clinics" id="clinics">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Recommended Clinics') }}</h2>
            </div>
            <div class="clinics-wrapper animate">
                <div class="clinics-map">
                    <img src="{{ asset('assets/images/map.png') }}" alt="Clinics Map">
                </div>
                <div class="clinics-content">
                    <div class="clinics-grid">
                        @foreach ($clinics as $clinic)
                            <div class="clinic-card" data-clinic-id="{{ $clinic->id }}">
                                <div class="clinic-name">{{ $clinic->name }} <span
                                        class="distance-badge">{{ $clinic->distance }} km</span></div>
                                <div class="clinic-info"><i class="fas fa-map-marker-alt"></i> {{ $clinic->location }}
                                </div>
                                <div class="clinic-info"><i class="fas fa-phone"></i> <a href="tel:{{ $clinic->phone }}"
                                        class="phone-link">{{ $clinic->phone }}</a></div>
                                <div class="clinic-info"><i class="fas fa-clock"></i> {{ $clinic->working_hours }}</div>
                            </div>
                        @endforeach
                    </div>
                    <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                        class="find-btn" data-action="find-clinic">{{ __('Find Nearest Clinic') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Bo -->
    <section class="dr-bo" id="dr-bo">
        <div class="container dr-bo-container animate">
            <div class="dr-bo-img">
                <img src="{{ asset('assets/images/Pawmic1 1.png') }}" alt="Dr. Bo">
            </div>
            <div class="dr-bo-content">
                <h2>{{ __('Meet Dr. Bo') }}</h2>
                <p>{{ __('Your smart AI assistant') }}</p>
                <div class="typing-text">{{ __('Ask me anything about pet health, nutrition, behavior...') }}</div>
                <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank" class="talk-btn"
                    data-action="talk-to-drbo">{{ __('Talk to Dr. Bo Now') }}</a>
            </div>
            <div class="chat-interface">
                <div class="chat-header">
                    <div class="chat-avatar">DB</div>
                    <div>
                        <h4 style="margin:0;color:white;">Dr. Bo</h4>
                        <p style="margin:0;font-size:14px;opacity:0.9;">{{ __('Always here to help') }}</p>
                    </div>
                </div>
                <div class="chat-message">{{ __('My dog isn\'t eating well today. Should I be worried?') }}</div>
                <div class="chat-message">
                    {{ __('Don\'t worry! It\'s normal for dogs to have occasional appetite changes. Monitor for 24 hours. If symptoms persist or worsen, consult a vet.') }}
                </div>
                <div class="typing-indicator">
                    <span>{{ __('Ask Dr. Bo anything...') }}</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pet Posts Section -->
    <section class="pet-posts" id="petposts">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Pet Posts') }}</h2>
                <p>{{ __('Browse stories, tips, and pet care content.') }}</p>
            </div>
            <div class="pet-posts-grid">
                @foreach ($petPosts as $post)
                    <div class="pet-post-card animate" data-post-id="{{ $post->id }}">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('assets/images/post1.png') }}"
                            alt="{{ $post->title }}">
                        <div class="post-info">
                            <h4>{{ $post->title }}</h4>
                            <p>{{ $post->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="reviews">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('What Pet Parents Say') }}</h2>
            </div>
            <div class="reviews-grid">
                @foreach ($reviews as $review)
                    <div class="review-card animate" data-review-id="{{ $review->id }}">
                        <div class="quote">"</div>
                        <div class="stars">★★★★★</div>
                        <p>"{{ $review->content }}"</p>
                        <div class="reviewer">
                            <img src="{{ $review->reviewer_image ? asset('storage/' . $review->reviewer_image) : asset('assets/images/Image (Sarah Mohammed).png') }}"
                                alt="{{ $review->reviewer_name }}">
                            <div class="reviewer-info">
                                <h4>{{ $review->reviewer_name }}</h4>
                                <span>{{ $review->date }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-stat="rating">
                    <div class="number">4.9/5</div>
                    <div class="label">{{ __('Average Rating') }}</div>
                </div>
                <div class="stat-item" data-stat="users">
                    <div class="number">10K+</div>
                    <div class="label">{{ __('Happy Users') }}</div>
                </div>
                <div class="stat-item" data-stat="clinics">
                    <div class="number">500+</div>
                    <div class="label">{{ __('Partner Clinics') }}</div>
                </div>
                <div class="stat-item" data-stat="support">
                    <div class="number">24/7</div>
                    <div class="label">{{ __('Support') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="about-us" id="about">
        <div class="container about-container animate">
            <div class="about-img"><img src="{{ asset('assets/images/team.png') }}" alt="PawApp Team"></div>
            <div class="about-content">
                <h2>{{ __('About Us') }}</h2>
                <p>{{ __('PawApp — where every pet finds care, love, and connection.') }}</p>
                <p>{{ __('We make pet care simple and smart — from finding trusted vets to shopping for essentials and chatting with our AI friend Dr. Bo.') }}
                </p>
                <p>{{ __('Our goal is to create a better world for pets and their humans — because your pet deserves the best.') }}
                </p>
            </div>
        </div>
    </section>

    <!-- New Banner -->
    <section class="banner-section">
        <img src="{{ asset('assets/images/Top Image Container.png') }}" alt="Welcome to PawApp Banner">
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="container contact-container animate">
            <div class="contact-info">
                <h2>{{ __('Contact Us') }}</h2>
                <p>{{ __('Let\'s talk with us') }}</p>
                <p>{{ __('Questions, comments, or suggestions? Simply fill in the form and we\'ll be in touch shortly.') }}
                </p>
                <div class="contact-detail"><i class="fas fa-map-marker-alt"></i> Pet City, PC 12345</div>
                <div class="contact-detail"><i class="fas fa-phone"></i> <a href="tel:+96541117003"
                        class="phone-link">+96541117003</a></div>
                <div class="contact-detail"><i class="fas fa-envelope"></i> <a href="mailto:info@pawapp.net"
                        class="email-link">info@pawapp.net</a></div>
            </div>
            <form class="contact-form" id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group"><input type="text" placeholder="{{ __('First Name*') }}" required
                            name="first_name">
                    </div>
                    <div class="form-group"><input type="text" placeholder="{{ __('Last Name*') }}" required
                            name="last_name">
                    </div>
                </div>
                <div class="form-group"><input type="email" placeholder="{{ __('Email*') }}" required
                        name="email"></div>
                <div class="form-group"><input type="tel" placeholder="{{ __('Phone Number*') }}" required
                        name="phone"></div>
                <div class="form-group">
                    <textarea placeholder="{{ __('Your message...') }}" rows="5" name="message"></textarea>
                </div>
                <button type="submit" class="submit-btn">{{ __('Send Message') }}</button>
            </form>
        </div>
    </section>

    <!-- Partners Auto-Scroll -->
    <section class="partners-auto">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Our Partners') }}</h2>
            </div>
            <div class="partners-track">
                @foreach ($partners as $partner)
                    <img src="{{ $partner->logo ? asset('storage/' . $partner->logo) : asset('assets/images/Partner logo-1.png') }}"
                        alt="{{ $partner->name }}" data-partner-id="{{ $partner->id }}">
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer role="contentinfo">
        <div class="container footer-content">
            <div class="footer-top">
                <img src="{{ asset('assets/icons/logo.svg') }}" alt="PawApp Logo" class="footer-logo">
                <span
                    class="footer-text">{{ __('Your complete pet care companion. Everything your pet needs in one place.') }}</span>
            </div>
            <hr class="footer-line">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>{{ __('Reach Us') }}</h4>
                    <a href="tel:+10123456789"><i class="fas fa-phone"></i> +1012 3456 789</a>
                    <a href="mailto:demo@gmail.com"><i class="fas fa-envelope"></i> demo@gmail.com</a>
                    <a href="#"><i class="fas fa-map-marker-alt"></i> Pet City, PC 12345</a>
                </div>
                <div class="footer-col">
                    <h4>{{ __('Quick Links') }}</h4>
                    <a href="#">{{ __('Home') }}</a>
                    <a href="#">{{ __('Store') }}</a>
                    <a href="#">{{ __('Clinic') }}</a>
                </div>
                <div class="footer-col">
                    <h4>{{ __('Services') }}</h4>
                    <a href="#clinics">{{ __('Clinics') }}</a>
                    <a href="#petposts">{{ __('Pet Posts') }}</a>
                    <a href="#store">{{ __('Store') }}</a>
                    <a href="#dr-bo">{{ __('Dr. Bo') }}</a>
                </div>
                <div class="footer-col">
                    <h4>{{ __('Follow Us') }}</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 PawApp – All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection
