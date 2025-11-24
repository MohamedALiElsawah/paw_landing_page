<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Dynamic SEO Meta Tags -->
    @php
        use App\Services\SEOService;
        $metaTags = SEOService::generateMetaTags(
            $title ?? null,
            $description ?? null,
            $keywords ?? null,
            $image ?? null,
            $url ?? null,
            $type ?? 'website',
        );
    @endphp

    <title>{{ $metaTags['title'] }}</title>
    <meta name="description" content="{{ $metaTags['description'] }}">
    <meta name="keywords" content="{{ $metaTags['keywords'] }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $metaTags['og_title'] }}">
    <meta property="og:description" content="{{ $metaTags['og_description'] }}">
    <meta property="og:image" content="{{ $metaTags['og_image'] }}">
    <meta property="og:url" content="{{ $metaTags['og_url'] }}">
    <meta property="og:type" content="{{ $metaTags['og_type'] }}">
    <meta property="og:site_name" content="{{ \App\Models\Setting::getValue('site_name', 'PawApp') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $metaTags['twitter_card'] }}">
    <meta name="twitter:title" content="{{ $metaTags['twitter_title'] }}">
    <meta name="twitter:description" content="{{ $metaTags['twitter_description'] }}">
    <meta name="twitter:image" content="{{ $metaTags['twitter_image'] }}">

    <!-- SEO Verification Tags -->
    {!! SEOService::generateVerificationTags() !!}

    <!-- Schema Markup -->
    <script type="application/ld+json">
        {!! json_encode(SEOService::generateSchemaMarkup('Organization')) !!}
    </script>

    <!-- Analytics Scripts -->
    {!! SEOService::generateAnalyticsScripts() !!}

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Tajawal:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <style>
        :root {
            --font-family: {{ app()->getLocale() == 'ar' ? 'Tajawal, Cairo, sans-serif' : 'Cairo, sans-serif' }};
        }

        body {
            font-family: var(--font-family);
        }
    </style>
</head>

<body>
    <!-- Floating SOP Button -->
    <button class="floating-sop" id="sop-btn" data-action="open-sop-modal">
        <img src="{{ asset('assets/images/SOP.png') }}" alt="SOP">
    </button>

    <!-- Header -->
    <header class="header" id="header">
        <div class="container header-container">
            <div class="logo">
                <img src="{{ asset('assets/icons/logo.svg') }}" alt="PawApp Logo">
            </div>
            <button class="hamburger" id="hamburger" data-action="toggle-sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="nav">
                <a href="#" class="nav-link" data-section="home">{{ __('Home') }}</a>
                <a href="#store" class="nav-link" data-section="store">{{ __('Store') }}</a>
                <a href="#clinics" class="nav-link" data-section="clinics">{{ __('Clinics') }}</a>
                <a href="#dr-bo" class="nav-link" data-section="dr-bo">{{ __('Dr. Bo') }}</a>
                <a href="#about" class="nav-link" data-section="about">{{ __('About Us') }}</a>
                <a href="#contact" class="nav-link" data-section="contact">{{ __('Contact Us') }}</a>
            </nav>
            <div class="lang-switch">
                <button class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" data-lang="en">EN</button>
                <span>|</span>
                <button class="lang-btn {{ app()->getLocale() == 'ar' ? 'active' : '' }}" data-lang="ar">عربي</button>
            </div>
            <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                class="download-btn" data-action="download-app">{{ __('Download App') }}</a>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-nav">
            <a href="#" class="nav-link" data-section="home">{{ __('Home') }}</a>
            <a href="#store" class="nav-link" data-section="store">{{ __('Store') }}</a>
            <a href="#clinics" class="nav-link" data-section="clinics">{{ __('Clinics') }}</a>
            <a href="#dr-bo" class="nav-link" data-section="dr-bo">{{ __('Dr. Bo') }}</a>
            <a href="#about" class="nav-link" data-section="about">{{ __('About Us') }}</a>
            <a href="#contact" class="nav-link" data-section="contact">{{ __('Contact Us') }}</a>
        </div>
        <div class="sidebar-lang-switch">
            <button class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" data-lang="en">EN</button>
            <span>|</span>
            <button class="lang-btn {{ app()->getLocale() == 'ar' ? 'active' : '' }}" data-lang="ar">عربي</button>
        </div>
        <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
            class="sidebar-download-btn" data-action="download-app">{{ __('Download App') }}</a>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay" data-action="close-sidebar"></div>

    @yield('content')

    <!-- SOP Modal -->
    <div class="sop-modal" id="sop-modal">
        <div class="sop-content">
            <span class="close-sop" id="close-sop" data-action="close-sop-modal">×</span>
            <div class="sop-header">
                <h2 class="sop-title">Emergency Services (SOP)</h2>
                <p class="sop-subtitle">24/7 emergency veterinary care, animal rescue, training, and specialized
                    services for critical situations.</p>
            </div>
            <div class="sop-services">
                <div class="sop-service"><i class="fas fa-bell"></i> Emergency Clinics</div>
                <div class="sop-service"><i class="fas fa-hand-holding-heart"></i> Animal Care</div>
                <div class="sop-service"><i class="fas fa-graduation-cap"></i> Training</div>
                <div class="sop-service"><i class="fas fa-heart"></i> Animal Rescue</div>
            </div>
            <a href="https://play.google.com/store/apps/details?id=com.paw.customer" target="_blank"
                class="access-btn" data-action="access-emergency">Access Emergency Services</a>
            <div class="important-box"><strong>Important:</strong><br>For life-threatening emergencies, please call
                your nearest veterinary hospital immediately or dial emergency services.</div>
            <div class="hotline">
                <div>
                    <div style="font-size:14px;opacity:.9;">24/7 Emergency Hotline</div>
                    <div style="font-size:20px;">+965 4111 7003</div>
                </div>
                <div class="phone-icon"><i class="fas fa-phone"></i></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        // Language switching functionality
        document.querySelectorAll('.lang-btn').forEach(button => {
            button.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                window.location.href = "{{ route('locale.change', ':lang') }}".replace(':lang', lang);
            });
        });
    </script>
</body>

</html>
