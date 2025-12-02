@extends('layouts.app')

@section('content')
    <div class="container privacy-container" style="padding: 40px 20px; max-width: 900px; margin: 80px auto 0 auto;">
        <h1 style="text-align: center; margin-bottom: 40px;">Privacy Policy</h1>

        <!-- Privacy Policy -->
        <section class="policy-section" style="margin-bottom: 50px;">
            <p><strong>Last Updated: 2025/12/02</strong></p>
            <p>Welcome to www.pawapp.net, the official website of PawApp (“we”, “us”).<br>
                We are committed to protecting your privacy and ensuring that your personal information is handled securely
                and responsibly.</p>
            <p>By using our Website, you agree to the practices described in this Privacy Policy.</p>

            <h3>1. Information We Collect</h3>
            <h4>1.1 Information You Provide Directly</h4>
            <p>When you use our Website or submit a contact form, we may collect:</p>
            <ul>
                <li>Name (if provided)</li>
                <li>Email address</li>
                <li>Phone number</li>
                <li>Any message or information you send through the contact form</li>
            </ul>
            <p>Note: www.pawapp.net is a Landing Page and does not require account creation or sensitive personal data.</p>

            <h4>1.2 Information Collected Automatically</h4>
            <p>When you visit our Website, we may automatically collect:</p>
            <ul>
                <li>IP address</li>
                <li>Browser and device type</li>
                <li>Pages visited and time spent on the site</li>
                <li>Cookies and usage data</li>
            </ul>
            <p>This data is used only to improve the Website performance and user experience.</p>

            <h3>2. How We Use Your Information</h3>
            <p>We may use collected information to:</p>
            <ul>
                <li>Respond to your inquiries</li>
                <li>Improve Website performance and user experience</li>
                <li>Analyze visitor traffic and page usage</li>
                <li>Ensure security and prevent misuse</li>
            </ul>
            <p>We do NOT use your information for marketing purposes without your consent.</p>

            <h3>3. Sharing Your Information</h3>
            <p>We do not sell any personal information.<br>
                We may share data only in the following cases:</p>
            <ul>
                <li>With our hosting provider to operate the Website</li>
                <li>With analytics services (such as Google Analytics, if used)</li>
                <li>When legally required by authorities or courts</li>
            </ul>

            <h3>4. Data Protection</h3>
            <p>We protect your information through:</p>
            <ul>
                <li>Secure HTTPS connection</li>
                <li>Server-level security measures</li>
                <li>Restricted access to authorized personnel only</li>
            </ul>
            <p>However, no method of online transmission is 100% secure, but we strive to minimize risks.</p>

            <h3>5. Cookies</h3>
            <p>Our Website uses cookies to:</p>
            <ul>
                <li>Improve website loading and performance</li>
                <li>Analyze visitor traffic</li>
                <li>Save browsing preferences</li>
            </ul>
            <p>You may disable or manage cookies through your browser settings.</p>

            <h3>6. External Links</h3>
            <p>Our Website may contain links to third-party sites.<br>
                We are not responsible for the content or privacy practices of those websites.</p>

            <h3>7. Your Rights</h3>
            <p>You have the right to:</p>
            <ul>
                <li>Request details about the data we may have collected</li>
                <li>Request correction or deletion of previously submitted contact information</li>
                <li>Contact us regarding any privacy-related inquiry</li>
            </ul>
            <p>Contact us:<br>
                📩 info@pawapp.net<br>
                📞 41117003</p>

            <h3>8. Changes to This Privacy Policy</h3>
            <p>We may update this Privacy Policy when needed.<br>
                Any changes will be posted on this page with an updated “Last Updated” date.</p>
        </section>

        <div style="text-align: center; margin-top: 60px; color: #666; font-size: 0.9em;">
            <p>If you have any questions about this privacy policy, please contact us at info@pawapp.net.</p>
        </div>
    </div>

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
                    <a href="#">{{ __('Clinics') }}</a>
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
                <p>{{ __('© 2025 PawApp – All rights reserved.') }}</p>
            </div>
        </div>
    </footer>
@endsection
