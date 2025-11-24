@extends('admin.layouts.app')

@section('title', 'SEO Management')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">
                        <i class="fas fa-search me-2"></i>
                        SEO Management
                    </h1>
                    <div class="btn-group">
                        <a href="{{ route('admin.seo.regenerate') }}" class="btn btn-warning">
                            <i class="fas fa-sync-alt me-2"></i>
                            Regenerate SEO Files
                        </a>
                        <a href="{{ route('admin.seo.analytics') }}" class="btn btn-info">
                            <i class="fas fa-chart-line me-2"></i>
                            Analytics
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic SEO Settings -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-tags me-2"></i>
                        Basic SEO Settings
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Meta Title -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Meta Title</label>
                            <small class="form-text text-muted d-block">Main title for search engines (max 60
                                characters)</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="meta_title"
                                value="{{ old('meta_title', $seoSettings['meta_title']) }}" class="form-control"
                                placeholder="PawApp - Everything Your Pet Needs in One Place">
                            <div class="form-text">
                                <span id="title-counter">0</span>/60 characters
                            </div>
                        </div>
                    </div>

                    <!-- Meta Description -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Meta Description</label>
                            <small class="form-text text-muted d-block">Brief description for search results (max 160
                                characters)</small>
                        </div>
                        <div class="col-md-8">
                            <textarea name="meta_description" class="form-control" rows="3"
                                placeholder="Find the best pet care services, clinics, and stores near you.">{{ old('meta_description', $seoSettings['meta_description']) }}</textarea>
                            <div class="form-text">
                                <span id="description-counter">0</span>/160 characters
                            </div>
                        </div>
                    </div>

                    <!-- Meta Keywords -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Meta Keywords</label>
                            <small class="form-text text-muted d-block">Comma-separated keywords for search engines</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="meta_keywords"
                                value="{{ old('meta_keywords', $seoSettings['meta_keywords']) }}" class="form-control"
                                placeholder="pet care, veterinary, pet stores, animal clinics">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics & Tracking -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Analytics & Tracking
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
                            <input type="text" name="google_analytics_id"
                                value="{{ old('google_analytics_id', $seoSettings['google_analytics_id']) }}"
                                class="form-control" placeholder="G-XXXXXXXXXX">
                        </div>
                    </div>

                    <!-- Facebook Pixel -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Facebook Pixel ID</label>
                            <small class="form-text text-muted d-block">Your Facebook Pixel tracking ID</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="facebook_pixel_id"
                                value="{{ old('facebook_pixel_id', $seoSettings['facebook_pixel_id']) }}"
                                class="form-control" placeholder="XXXXXXXXXXXXXXX">
                        </div>
                    </div>

                    <!-- Google Search Console -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Google Search Console</label>
                            <small class="form-text text-muted d-block">Meta tag content for Google Search Console
                                verification</small>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="google_search_console"
                                value="{{ old('google_search_console', $seoSettings['google_search_console']) }}"
                                class="form-control" placeholder="google-site-verification=...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced SEO -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Advanced SEO
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Schema Markup -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Organization Schema</label>
                            <small class="form-text text-muted d-block">JSON-LD schema markup for your organization</small>
                        </div>
                        <div class="col-md-8">
                            <textarea name="organization_schema" class="form-control" rows="4"
                                placeholder='{"@context": "https://schema.org", "@type": "Organization", ...}'>{{ old('organization_schema', $seoSettings['organization_schema']) }}</textarea>
                        </div>
                    </div>

                    <!-- Robots.txt -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Custom Robots.txt</label>
                            <small class="form-text text-muted d-block">Custom robots.txt directives</small>
                        </div>
                        <div class="col-md-8">
                            <textarea name="custom_robots_txt" class="form-control" rows="3" placeholder="User-agent: *&#10;Allow: /">{{ old('custom_robots_txt', $seoSettings['custom_robots_txt']) }}</textarea>
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
                            <input type="number" name="sitemap_priority"
                                value="{{ old('sitemap_priority', $seoSettings['sitemap_priority']) }}"
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
                                @if ($seoSettings['og_image'])
                                    <div class="me-3">
                                        <img src="{{ Storage::url($seoSettings['og_image']) }}" alt="Open Graph Image"
                                            class="img-thumbnail" style="max-height: 80px;">
                                    </div>
                                @endif
                                <input type="file" name="og_image" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Files Preview -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-code me-2"></i>
                        SEO Files Preview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6>Sitemap.xml</h6>
                                <a href="{{ route('admin.seo.preview-sitemap') }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    View Full
                                </a>
                            </div>
                            <pre class="bg-light p-3 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"><code>{{ $sitemapPreview }}</code></pre>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6>Robots.txt</h6>
                                <a href="{{ route('admin.seo.preview-robots') }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    View Full
                                </a>
                            </div>
                            <pre class="bg-light p-3 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"><code>{{ $robotsPreview }}</code></pre>
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
                            Save SEO Settings
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Character counters
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.querySelector('input[name="meta_title"]');
            const descriptionInput = document.querySelector('textarea[name="meta_description"]');
            const titleCounter = document.getElementById('title-counter');
            const descriptionCounter = document.getElementById('description-counter');

            function updateCounters() {
                if (titleInput && titleCounter) {
                    titleCounter.textContent = titleInput.value.length;
                }
                if (descriptionInput && descriptionCounter) {
                    descriptionCounter.textContent = descriptionInput.value.length;
                }
            }

            if (titleInput) {
                titleInput.addEventListener('input', updateCounters);
            }
            if (descriptionInput) {
                descriptionInput.addEventListener('input', updateCounters);
            }

            // Initialize counters
            updateCounters();
        });
    </script>
@endpush
