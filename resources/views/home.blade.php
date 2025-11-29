@extends('layouts.app')

@section('content')
    <!-- Top Header Banner -->
    <div class="top-header-banner">
        <div class="container">
            <div class="top-header-content">
                <p>{{ App\Models\Setting::getValue('top_header_text', __('Download PawApp Now - Your Complete Pet Care Companion')) }}
                </p>
                <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                    class="top-header-btn">
                    {{ __('Get App') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section with Banner Carousel -->
    <section class="hero animate" id="home">
        <div class="hero-bg-element hero-bg-1"></div>
        <div class="hero-bg-element hero-bg-2"></div>
        <div class="hero-bg-element hero-bg-3"></div>
        <div class="container hero-container">
            <div class="hero-content">
                @if ($banners->count() > 0)
                    <div class="banner-carousel">
                        @foreach ($banners as $index => $banner)
                            <div class="banner-slide {{ $index === 0 ? 'active' : '' }}"
                                data-banner-id="{{ $banner->id }}">
                                <h1 class="hero-title">
                                    {{ $banner->title ?: App\Models\Setting::getValue('hero_title', __('All Your Pet Needs in One App')) }}
                                </h1>
                                <p class="hero-text">
                                    {{ $banner->description ?: App\Models\Setting::getValue('hero_description', __('Complete pet care in your hands. Easily and quickly find everything using a single app.')) }}
                                </p>
                                <div class="hero-buttons">
                                    <a href="{{ $banner->button_url ?: 'https://play.google.com/store/apps/details?id=com.paw.customer' }}"
                                        target="_blank" class="btn-primary" data-action="download-app">
                                        {{ $banner->button_text ?: __('Download App') }}
                                    </a>
                                    <a href="#services" class="btn-outline" data-action="scroll-to-services">
                                        {{ __('Explore Services') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Banner Navigation Dots -->
                    <div class="banner-dots">
                        @foreach ($banners as $index => $banner)
                            <button class="banner-dot {{ $index === 0 ? 'active' : '' }}"
                                data-slide="{{ $index }}"></button>
                        @endforeach
                    </div>
                @else
                    <h1 class="hero-title">
                        {{ App\Models\Setting::getValue('hero_title', __('All Your Pet Needs in One App')) }}
                    </h1>
                    <p class="hero-text">
                        {{ App\Models\Setting::getValue('hero_description', __('Complete pet care in your hands. Easily and quickly find everything using a single app.')) }}
                    </p>
                    <div class="hero-buttons">
                        <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                            class="btn-primary" data-action="download-app">
                            {{ __('Download App') }}
                        </a>
                        <a href="#services" class="btn-outline" data-action="scroll-to-services">
                            {{ __('Explore Services') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="image-stack">
                @if ($banners->count() > 0)
                    <!-- Banner image carousel that syncs with content carousel -->
                    <div class="banner-image-carousel">
                        @foreach ($banners as $index => $banner)
                            <div class="banner-image-slide {{ $index === 0 ? 'active' : '' }}"
                                data-banner-id="{{ $banner->id }}">
                                <div class="phone-1">
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}">
                                </div>
                                <div class="phone-2">
                                    <img src="{{ $banner->secondary_image_url ?: $banner->image_url }}"
                                        alt="{{ $banner->title }}">
                                </div>
                                <div class="leo-mascot">
                                    <img src="{{ $banner->third_image_url }}" alt="{{ $banner->title }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Fallback to static phone images -->
                    <div class="phone-1">
                        <img src="{{ asset('assets/images/hero1.png') }}" alt="Screen 1">
                    </div>
                    <div class="phone-2">
                        <img src="{{ asset('assets/images/hero3.png') }}" alt="Screen 2">
                    </div>
                    <div class="leo-mascot">
                        <img src="{{ asset('assets/images/hero2.png') }}" alt="Mascot">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Our Services -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Our Services') }}</h2>
                <p>{{ App\Models\Setting::getValue('services_description', __('Everything you need for complete pet care in one app')) }}
                </p>
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
                <div class="discount-badge">{{ App\Models\Setting::getValue('store_discount', '25% OFF') }}</div>
                @if (App\Models\Setting::getValue('store_banner_left_image'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('store_banner_left_image')) }}"
                        alt="Pet Product Left">
                @else
                    <img src="{{ asset('assets/images/store_banner3.png') }}" alt="Pet Product Left">
                @endif
            </div>
            <div class="store-banner-center">
                <h3>{{ App\Models\Setting::getValue('store_banner_text', __('Visit the PawApp Store for exclusive offers!')) }}
                </h3>
                <a href="{{ App\Models\Setting::getValue('store_button_url', 'https://play.google.com/store/apps/details?id=com.paw.customer') }}"
                    target="_blank" class="visit-btn"
                    data-action="visit-store">{{ App\Models\Setting::getValue('store_button_text', __('Visit Store')) }}</a>
            </div>
            <div class="store-banner-right">
                @if (App\Models\Setting::getValue('store_banner_right_image_1'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('store_banner_right_image_1')) }}"
                        alt="Pet Product Right 1">
                @else
                    <img src="{{ asset('assets/images/store_banner1.png') }}" alt="Pet Product Right 1">
                @endif
                @if (App\Models\Setting::getValue('store_banner_right_image_2'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('store_banner_right_image_2')) }}"
                        alt="Pet Product Right 2">
                @else
                    <img src="{{ asset('assets/images/store_banner2.png') }}" alt="Pet Product Right 2">
                @endif
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
                    <p>{{ App\Models\Setting::getValue('address', __('123 Pet Street, Paw City')) }}</p>
                </div>
                <div class="info-box" data-info-type="hours">
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <h4>{{ __('Opening Hours') }}</h4>
                    <div class="working-hours-display">
                        <div class="working-hours-text">
                            {{ App\Models\Setting::getValue('working_hours', __('Mon-Sun: 9AM - 9PM')) }}
                        </div>
                        <div class="store-status">
                            <span class="status-indicator open"></span>
                            <span class="status-text">{{ __('Open Now') }}</span>
                        </div>
                    </div>
                </div>
                <div class="info-box" data-info-type="contact">
                    <div class="icon"><i class="fas fa-phone"></i></div>
                    <h4>{{ __('Contact') }}</h4>
                    <p><a href="tel:{{ App\Models\Setting::getValue('phone_number', '+96541117003') }}"
                            class="phone-link">{{ App\Models\Setting::getValue('phone_number', '+965 4111 7003') }}</a>
                    </p>
                </div>
                <div class="info-box" data-info-type="delivery">
                    <div class="icon"><i class="fas fa-truck"></i></div>
                    <h4>{{ __('Delivery') }}</h4>
                    <p>{{ App\Models\Setting::getValue('delivery_info', __('Free delivery over $50')) }}</p>
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
            <div class="scrollable-section">
                <div class="stores-scroll-container">
                    <div class="stores-scroll-wrapper">
                        @foreach ($stores as $store)
                            <div class="store-card" data-store-id="{{ $store->id }}">
                                <div class="store-img">
                                    <img src="{{ $store->image_url ?: asset('assets/images/store1.png') }}"
                                        alt="{{ $store->name }}">
                                    @if ($store->logo_url)
                                        <div class="store-logo"><img src="{{ $store->logo_url }}" alt="Logo">
                                        </div>
                                    @endif
                                </div>
                                <div class="store-info">
                                    <div class="store-name">{{ $store->name }} <span class="rating">★★★★★
                                            {{ $store->rating }}</span></div>
                                    <div class="store-detail"><i class="fas fa-phone"></i> <a
                                            href="tel:{{ $store->phone }}" class="phone-link">{{ $store->phone }}</a>
                                    </div>
                                    <div class="store-detail"><i class="fas fa-clock"></i>
                                        {{ $store->working_hours }}
                                        <span class="store-status"
                                            data-working-hours="{{ $store->working_hours }}"></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Clinics -->
    <section class="clinics" id="clinics">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('Recommended Clinics') }}</h2>
            </div>
            <div class="clinics-map-section animate">
                <div class="clinics-map-full">
                    <div id="clinics-map" style="width: 100%; height: 162px;"></div>
                </div>
            </div>
            <div class="clinics-cards-section animate">
                <div class="scrollable-section">
                    <div class="clinics-scroll-container">
                        <div class="clinics-scroll-wrapper">
                            @foreach ($clinics as $clinic)
                                <div class="clinic-card" data-clinic-id="{{ $clinic->id }}"
                                    data-lat="{{ $clinic->latitude }}" data-lng="{{ $clinic->longitude }}"
                                    onmouseover="highlightClinic({{ $clinic->id }})"
                                    onmouseout="unhighlightClinic({{ $clinic->id }})">
                                    <div class="clinic-name">{{ $clinic->name }}</div>
                                    <div class="clinic-info"><i class="fas fa-map-marker-alt"></i>
                                        {{ $clinic->location }}
                                    </div>
                                    <div class="clinic-info"><i class="fas fa-phone"></i> <a
                                            href="tel:{{ $clinic->phone }}" class="phone-link">{{ $clinic->phone }}</a>
                                    </div>
                                    <div class="clinic-info"><i class="fas fa-clock"></i> {{ $clinic->working_hours }}
                                    </div>
                                    @if ($clinic->latitude && $clinic->longitude)
                                        <div class="clinic-actions">
                                            <a href="https://www.openstreetmap.org/?mlat={{ $clinic->latitude }}&mlon={{ $clinic->longitude }}#map=15/{{ $clinic->latitude }}/{{ $clinic->longitude }}"
                                                target="_blank" class="browse-location-btn"
                                                data-action="browse-location">
                                                <i class="fas fa-external-link-alt"></i> {{ __('Browse Location') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="find-clinic-btn-container">
                        <a href="{{ App\Models\Setting::getValue('clinics_button_url', 'https://play.google.com/store/apps/details?id=com.paw.customer') }}"
                            target="_blank" class="find-btn"
                            data-action="find-clinic">{{ App\Models\Setting::getValue('clinics_button_text', __('Find Nearest Clinic')) }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctor Bo -->
    <section class="dr-bo" id="dr-bo">
        <div class="container dr-bo-container animate">
            <div class="dr-bo-img">
                @if (App\Models\Setting::getValue('dr_bo_image'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('dr_bo_image')) }}" alt="Dr. Bo">
                @else
                    <img src="{{ asset('assets/images/Pawmic1 1.png') }}" alt="Dr. Bo">
                @endif
            </div>
            <div class="dr-bo-content">
                <h2>{{ App\Models\Setting::getValue('dr_bo_title', __('Meet Dr. Bo')) }}</h2>
                <p>{{ App\Models\Setting::getValue('dr_bo_subtitle', __('Your smart AI assistant')) }}</p>
                <div class="typing-text">
                    {{ App\Models\Setting::getValue('dr_bo_description', __('Ask me anything about pet health, nutrition, behavior...')) }}
                </div>
                <a href="{{ App\Models\Setting::getValue('dr_bo_button_url', 'https://play.google.com/store/apps/details?id=com.paw.customer') }}"
                    target="_blank" class="talk-btn"
                    data-action="talk-to-drbo">{{ App\Models\Setting::getValue('dr_bo_button_text', __('Talk to Dr. Bo Now')) }}</a>
            </div>
            <div class="chat-interface">
                <div class="chat-header">
                    @if (App\Models\Setting::getValue('dr_bo_avatar'))
                        <div class="chat-avatar">
                            <img src="{{ Storage::url(App\Models\Setting::getValue('dr_bo_avatar')) }}"
                                alt="Dr. Bo Avatar">
                        </div>
                    @else
                        <div class="chat-avatar">DB</div>
                    @endif
                    <div>
                        <h4 style="margin:0;color:white;">{{ App\Models\Setting::getValue('dr_bo_name', __('Dr. Bo')) }}
                        </h4>
                        <p style="margin:0;font-size:14px;opacity:0.9;">
                            {{ App\Models\Setting::getValue('dr_bo_status', __('Always here to help')) }}</p>
                    </div>
                </div>
                <div class="chat-message">
                    {{ App\Models\Setting::getValue('dr_bo_example_question', __('My dog isn\'t eating well today. Should I be worried?')) }}
                </div>
                <div class="chat-message">
                    {{ App\Models\Setting::getValue('dr_bo_example_answer', __('Don\'t worry! It\'s normal for dogs to have occasional appetite changes. Monitor for 24 hours. If symptoms persist or worsen, consult a vet.')) }}
                </div>
                <div class="typing-indicator">
                    <span>{{ App\Models\Setting::getValue('dr_bo_typing_text', __('Ask Dr. Bo anything...')) }}</span>
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
                <p>{{ App\Models\Setting::getValue('pet_posts_description', __('Browse stories, tips, and pet care content.')) }}
                </p>
            </div>
            <div class="scrollable-section">
                <div class="pet-posts-scroll-container">
                    <div class="pet-posts-scroll-wrapper">
                        @foreach ($petPosts as $post)
                            <div class="pet-post-card" data-post-id="{{ $post->id }}">
                                <img src="{{ $post->image_url ?: asset('assets/images/post1.png') }}"
                                    alt="{{ $post->title }}">
                                <div class="post-info">
                                    <h4>{{ $post->title }}</h4>
                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="reviews">
        <div class="container">
            <div class="section-title animate">
                <h2>{{ __('What Pet Parents Say') }}</h2>
            </div>
            <div class="scrollable-section">
                <div class="reviews-scroll-container">
                    <div class="reviews-scroll-wrapper">
                        @foreach ($reviews as $review)
                            <div class="review-card" data-review-id="{{ $review->id }}">
                                <div class="quote">"</div>
                                <div class="stars">★★★★★</div>
                                <p>"{{ $review->content }}"</p>
                                <div class="reviewer">
                                    <img src="{{ $review->reviewer_image_url ?: asset('assets/images/Image (Sarah Mohammed).png') }}"
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
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item" data-stat="rating">
                    <div class="number">{{ App\Models\Setting::getValue('stats_rating', '4.9/5') }}</div>
                    <div class="label">{{ __('Average Rating') }}</div>
                </div>
                <div class="stat-item" data-stat="users">
                    <div class="number">{{ App\Models\Setting::getValue('stats_users', '10K+') }}</div>
                    <div class="label">{{ __('Happy Users') }}</div>
                </div>
                <div class="stat-item" data-stat="clinics">
                    <div class="number">{{ App\Models\Setting::getValue('stats_clinics', '500+') }}</div>
                    <div class="label">{{ __('Partner Clinics') }}</div>
                </div>
                <div class="stat-item" data-stat="support">
                    <div class="number">{{ App\Models\Setting::getValue('stats_support', '24/7') }}</div>
                    <div class="label">{{ __('Support') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section class="about-us" id="about">
        <div class="container about-container animate">
            <div class="about-img">
                @if (App\Models\Setting::getValue('about_us_image'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('about_us_image')) }}" alt="PawApp Team">
                @else
                    <img src="{{ asset('assets/images/team.png') }}" alt="PawApp Team">
                @endif
            </div>
            <div class="about-content">
                <h2>{{ __('About Us') }}</h2>
                <p>{{ App\Models\Setting::getValue('about_intro', __('PawApp — where every pet finds care, love, and connection.')) }}
                </p>
                <p>{{ App\Models\Setting::getValue('about_description', __('We make pet care simple and smart — from finding trusted vets to shopping for essentials and chatting with our AI friend Dr. Bo.')) }}
                </p>
                <p>{{ App\Models\Setting::getValue('about_mission', __('Our goal is to create a better world for pets and their humans — because your pet deserves the best.')) }}
                </p>
            </div>
        </div>
    </section>

    <!-- New Banner -->
    <section class="banner-section">
        @if (App\Models\Setting::getValue('footer_banner_image'))
            <img src="{{ Storage::url(App\Models\Setting::getValue('footer_banner_image')) }}"
                alt="Welcome to PawApp Banner">
        @else
            <img src="{{ asset('assets/images/Top Image Container.png') }}" alt="Welcome to PawApp Banner">
        @endif
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="container contact-container animate">
            <div class="contact-info">
                <h2>{{ __('Contact Us') }}</h2>
                <p>{{ App\Models\Setting::getValue('contact_subtitle', __('Let\'s talk with us')) }}</p>
                <p>{{ App\Models\Setting::getValue('contact_description', __('Questions, comments, or suggestions? Simply fill in the form and we\'ll be in touch shortly.')) }}
                </p>
                <div class="contact-detail"><i class="fas fa-map-marker-alt"></i>
                    {{ App\Models\Setting::getValue('address', 'Pet City, PC 12345') }}</div>
                <div class="contact-detail"><i class="fas fa-phone"></i> <a
                        href="tel:{{ App\Models\Setting::getValue('phone_number', '+96541117003') }}"
                        class="phone-link">{{ App\Models\Setting::getValue('phone_number', '+96541117003') }}</a></div>
                <div class="contact-detail"><i class="fas fa-envelope"></i> <a
                        href="mailto:{{ App\Models\Setting::getValue('email', 'info@pawapp.net') }}"
                        class="email-link">{{ App\Models\Setting::getValue('email', 'info@pawapp.net') }}</a></div>
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
                    <img src="{{ $partner->logo_url ?: asset('assets/images/Partner logo-1.png') }}"
                        alt="{{ $partner->name }}" data-partner-id="{{ $partner->id }}">
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer role="contentinfo">
        <div class="container footer-content">
            <div class="footer-top">
                @if (App\Models\Setting::getValue('site_logo'))
                    <img src="{{ Storage::url(App\Models\Setting::getValue('site_logo')) }}"
                        alt="{{ App\Models\Setting::getValue('site_name', 'PawApp') }} Logo" class="footer-logo">
                @else
                    <img src="{{ asset('assets/icons/logo.svg') }}" alt="PawApp Logo" class="footer-logo">
                @endif
                <span
                    class="footer-text">{{ App\Models\Setting::getValue('footer_description', __('Your complete pet care companion. Everything your pet needs in one place.')) }}</span>
            </div>
            <hr class="footer-line">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>{{ __('Reach Us') }}</h4>
                    <a href="tel:{{ App\Models\Setting::getValue('phone_number', '+10123456789') }}"><i
                            class="fas fa-phone"></i>
                        {{ App\Models\Setting::getValue('phone_number', '+1012 3456 789') }}</a>
                    <a href="mailto:{{ App\Models\Setting::getValue('email', 'demo@gmail.com') }}"><i
                            class="fas fa-envelope"></i>
                        {{ App\Models\Setting::getValue('email', 'demo@gmail.com') }}</a>
                    <a href="#"><i class="fas fa-map-marker-alt"></i>
                        {{ App\Models\Setting::getValue('address', 'Pet City, PC 12345') }}</a>
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
                        @if (App\Models\Setting::getValue('facebook_url'))
                            <a href="{{ App\Models\Setting::getValue('facebook_url') }}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (App\Models\Setting::getValue('instagram_url'))
                            <a href="{{ App\Models\Setting::getValue('instagram_url') }}" target="_blank"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                        @if (App\Models\Setting::getValue('twitter_url'))
                            <a href="{{ App\Models\Setting::getValue('twitter_url') }}" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if (App\Models\Setting::getValue('linkedin_url'))
                            <a href="{{ App\Models\Setting::getValue('linkedin_url') }}" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 PawApp – All rights reserved.</p>
            </div>
        </div>
    </footer>
@endsection
