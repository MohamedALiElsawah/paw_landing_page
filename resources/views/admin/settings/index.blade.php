@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-cog me-2"></i>
                        Settings
                    </h1>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- General Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-globe me-2"></i>
                        General Settings
                    </h5>
                </div>
                <div class="card-body">
                    @foreach ($settings['general'] ?? [] as $setting)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label
                                    class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                @if ($setting->description)
                                    <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                @endif
                            </div>
                            <div class="col-md-8">
                                @if ($setting->type === 'text')
                                    <input type="text" name="settings[{{ $setting->key }}]"
                                        value="{{ old("settings.{$setting->key}", $setting->value) }}" class="form-control"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                @elseif($setting->type === 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                @elseif($setting->type === 'image')
                                    <div class="d-flex align-items-center">
                                        @if ($setting->value)
                                            <div class="me-3">
                                                <img src="{{ Storage::url($setting->value) }}" alt="{{ $setting->key }}"
                                                    class="img-thumbnail" style="max-height: 80px;">
                                            </div>
                                        @endif
                                        <input type="file" name="settings[{{ $setting->key }}]" class="form-control">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-phone me-2"></i>
                        Contact Information
                    </h5>
                </div>
                <div class="card-body">
                    @foreach ($settings['contact'] ?? [] as $setting)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label
                                    class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                @if ($setting->description)
                                    <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                @endif
                            </div>
                            <div class="col-md-8">
                                @if ($setting->type === 'text' || $setting->type === 'phone' || $setting->type === 'email')
                                    <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}"
                                        name="settings[{{ $setting->key }}]"
                                        value="{{ old("settings.{$setting->key}", $setting->value) }}" class="form-control"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                @elseif($setting->type === 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Social Media Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-share-alt me-2"></i>
                        Social Media Links
                    </h5>
                </div>
                <div class="card-body">
                    @foreach ($settings['social'] ?? [] as $setting)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">
                                    <i class="fab fa-{{ str_replace('_url', '', $setting->key) }} me-2"></i>
                                    {{ ucfirst(str_replace('_url', '', str_replace('_', ' ', $setting->key))) }}
                                </label>
                                @if ($setting->description)
                                    <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <input type="url" name="settings[{{ $setting->key }}]"
                                    value="{{ old("settings.{$setting->key}", $setting->value) }}" class="form-control"
                                    placeholder="https://{{ str_replace('_url', '', $setting->key) }}.com/your-profile">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-search me-2"></i>
                        SEO Settings
                    </h5>
                </div>
                <div class="card-body">
                    @foreach ($settings['seo'] ?? [] as $setting)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label
                                    class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                                @if ($setting->description)
                                    <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                @endif
                            </div>
                            <div class="col-md-8">
                                @if ($setting->type === 'text')
                                    <input type="text" name="settings[{{ $setting->key }}]"
                                        value="{{ old("settings.{$setting->key}", $setting->value) }}" class="form-control"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                @elseif($setting->type === 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Advanced SEO Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Advanced SEO & Analytics
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Google Analytics -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Google Analytics ID</label>
                            <small class="form-text text-muted d-block">Your Google Analytics tracking ID (e.g.,
                                G-XXXXXXXXXX)</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="settings[google_analytics_id]"
                                value="{{ old('settings.google_analytics_id', \App\Models\Setting::getValue('google_analytics_id')) }}"
                                class="form-control" placeholder="G-XXXXXXXXXX">
                        </div>
                    </div>

                    <!-- Google Search Console -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Google Search Console Verification</label>
                            <small class="form-text text-muted d-block">Meta tag content for Google Search Console
                                verification</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="settings[google_search_console]"
                                value="{{ old('settings.google_search_console', \App\Models\Setting::getValue('google_search_console')) }}"
                                class="form-control" placeholder="google-site-verification=...">
                        </div>
                    </div>

                    <!-- Facebook Pixel -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Facebook Pixel ID</label>
                            <small class="form-text text-muted d-block">Your Facebook Pixel tracking ID</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="settings[facebook_pixel_id]"
                                value="{{ old('settings.facebook_pixel_id', \App\Models\Setting::getValue('facebook_pixel_id')) }}"
                                class="form-control" placeholder="XXXXXXXXXXXXXXX">
                        </div>
                    </div>

                    <!-- Schema Markup -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Organization Schema</label>
                            <small class="form-text text-muted d-block">JSON-LD schema markup for your organization</small>
                        </div>
                        <div class="col-md-8">
                            <textarea name="settings[organization_schema]" class="form-control" rows="4"
                                placeholder='{"@context": "https://schema.org", "@type": "Organization", ...}'>{{ old('settings.organization_schema', \App\Models\Setting::getValue('organization_schema')) }}</textarea>
                        </div>
                    </div>

                    <!-- Robots.txt -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Custom Robots.txt</label>
                            <small class="form-text text-muted d-block">Custom robots.txt directives</small>
                        </div>
                        <div class="col-md-8">
                            <textarea name="settings[custom_robots_txt]" class="form-control" rows="3"
                                placeholder="User-agent: *&#10;Allow: /">{{ old('settings.custom_robots_txt', \App\Models\Setting::getValue('custom_robots_txt')) }}</textarea>
                        </div>
                    </div>

                    <!-- Sitemap Priority -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Sitemap Priority</label>
                            <small class="form-text text-muted d-block">Default priority for sitemap URLs (0.1 -
                                1.0)</small>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="settings[sitemap_priority]"
                                value="{{ old('settings.sitemap_priority', \App\Models\Setting::getValue('sitemap_priority', '0.8')) }}"
                                class="form-control" min="0.1" max="1.0" step="0.1" placeholder="0.8">
                        </div>
                    </div>

                    <!-- Open Graph Image -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Open Graph Image</label>
                            <small class="form-text text-muted d-block">Default image for social media sharing</small>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                @if (\App\Models\Setting::getValue('og_image'))
                                    <div class="me-3">
                                        <img src="{{ Storage::url(\App\Models\Setting::getValue('og_image')) }}"
                                            alt="Open Graph Image" class="img-thumbnail" style="max-height: 80px;">
                                    </div>
                                @endif
                                <input type="file" name="settings[og_image]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-paw btn-lg">
                            <i class="fas fa-save me-2"></i>
                            Save Settings
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
