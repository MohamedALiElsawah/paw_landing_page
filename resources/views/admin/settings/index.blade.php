@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <!-- Dynamic Banner -->
    <div class="dynamic-banner-container mb-4">
        <section class="dynamic-banner" id="dynamic-banner">
            <div class="banner-content">
                <div class="banner-text active" id="banner-text" data-banner-index="0">
                    {{ App\Models\Setting::getValue('top_header_text', __('Download PawApp Now - Your Complete Pet Care Companion')) }}
                </div>
                <img src="{{ asset('assets/images/catBanner.png') }}" alt="Cat" class="banner-cat">
            </div>
        </section>
    </div>

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-cog me-2"></i>
                    Settings
                </h1>
                <p class="text-muted mb-0">Manage application settings and configurations</p>
            </div>
        </div>
    </div>

    <!-- Settings Form -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-sliders-h me-2"></i>
                Application Settings
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Language Tabs -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-language me-2"></i>
                            Language Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Settings marked with <span class="badge bg-primary">Multilingual</span> support both English and
                            Arabic versions.
                        </div>
                    </div>
                </div>

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
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'site_name' => ['en' => 'Site Name', 'ar' => 'اسم الموقع'],
                                                'site_description' => [
                                                    'en' => 'Site Description',
                                                    'ar' => 'وصف الموقع',
                                                ],
                                                'site_logo' => ['en' => 'Site Logo', 'ar' => 'شعار الموقع'],
                                                'site_favicon' => ['en' => 'Site Favicon', 'ar' => 'أيقونة الموقع'],
                                                'default_language' => [
                                                    'en' => 'Default Language',
                                                    'ar' => 'اللغة الافتراضية',
                                                ],
                                                'timezone' => ['en' => 'Timezone', 'ar' => 'المنطقة الزمنية'],
                                                'currency' => ['en' => 'Currency', 'ar' => 'العملة'],
                                                'date_format' => ['en' => 'Date Format', 'ar' => 'تنسيق التاريخ'],
                                                'time_format' => ['en' => 'Time Format', 'ar' => 'تنسيق الوقت'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][en]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                        class="form-control"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][ar]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                        class="form-control" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @elseif($setting->type === 'image')
                                            <div class="d-flex align-items-center">
                                                @if ($setting->value)
                                                    <div class="me-3">
                                                        <img src="{{ Storage::url($setting->value) }}"
                                                            alt="{{ $setting->key }}" class="img-thumbnail"
                                                            style="max-height: 80px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="settings[{{ $setting->key }}]"
                                                    class="form-control">
                                            </div>
                                        @endif
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
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'contact_email' => [
                                                    'en' => 'Contact Email',
                                                    'ar' => 'البريد الإلكتروني للتواصل',
                                                ],
                                                'contact_phone' => [
                                                    'en' => 'Contact Phone',
                                                    'ar' => 'رقم الهاتف للتواصل',
                                                ],
                                                'contact_address' => [
                                                    'en' => 'Contact Address',
                                                    'ar' => 'عنوان التواصل',
                                                ],
                                                'business_hours' => ['en' => 'Business Hours', 'ar' => 'ساعات العمل'],
                                                'emergency_contact' => [
                                                    'en' => 'Emergency Contact',
                                                    'ar' => 'الاتصال في حالات الطوارئ',
                                                ],
                                                'phone_number' => ['en' => 'Phone Number', 'ar' => 'رقم الهاتف'],
                                                'email' => ['en' => 'Email', 'ar' => 'البريد الإلكتروني'],
                                                'address' => ['en' => 'Address', 'ar' => 'العنوان'],
                                                'working_hours' => ['en' => 'Working Hours', 'ar' => 'ساعات العمل'],
                                                'contact_subtitle' => [
                                                    'en' => 'Contact Subtitle',
                                                    'ar' => 'عنوان فرعي للتواصل',
                                                ],
                                                'contact_description' => [
                                                    'en' => 'Contact Description',
                                                    'ar' => 'وصف التواصل',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text' || $setting->type === 'phone' || $setting->type === 'email')
                                            <input type="{{ $setting->type === 'email' ? 'email' : 'text' }}"
                                                name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
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
                                        @php
                                            $label = [
                                                'facebook_url' => ['en' => 'Facebook URL', 'ar' => 'رابط الفيسبوك'],
                                                'twitter_url' => ['en' => 'Twitter URL', 'ar' => 'رابط تويتر'],
                                                'instagram_url' => ['en' => 'Instagram URL', 'ar' => 'رابط إنستغرام'],
                                                'linkedin_url' => ['en' => 'LinkedIn URL', 'ar' => 'رابط لينكد إن'],
                                                'youtube_url' => ['en' => 'YouTube URL', 'ar' => 'رابط يوتيوب'],
                                                'whatsapp_url' => ['en' => 'WhatsApp URL', 'ar' => 'رابط واتساب'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(
                                                    str_replace('_url', '', str_replace('_', ' ', $setting->key)),
                                                ),
                                                'ar' => ucfirst(
                                                    str_replace('_url', '', str_replace('_', ' ', $setting->key)),
                                                ),
                                            ];
                                        @endphp
                                        <i class="fab fa-{{ str_replace('_url', '', $setting->key) }} me-2"></i>
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <input type="url" name="settings[{{ $setting->key }}]"
                                        value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                        class="form-control"
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
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'meta_title' => ['en' => 'Meta Title', 'ar' => 'عنوان الميتا'],
                                                'meta_description' => [
                                                    'en' => 'Meta Description',
                                                    'ar' => 'وصف الميتا',
                                                ],
                                                'meta_keywords' => [
                                                    'en' => 'Meta Keywords',
                                                    'ar' => 'كلمات مفتاحية للميتا',
                                                ],
                                                'google_analytics' => [
                                                    'en' => 'Google Analytics',
                                                    'ar' => 'جوجل أناليتكس',
                                                ],
                                                'google_site_verification' => [
                                                    'en' => 'Google Site Verification',
                                                    'ar' => 'تحقق موقع جوجل',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->type === 'text')
                                        <input type="text" name="settings[{{ $setting->key }}]"
                                            value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                            class="form-control"
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

                <!-- Banner Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-purple text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-flag me-2"></i>
                            Banner Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['banner'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'top_header_text' => [
                                                    'en' => 'Top Header Text',
                                                    'ar' => 'نص الهيدر العلوي',
                                                ],
                                                'banner_enabled' => ['en' => 'Banner Enabled', 'ar' => 'تفعيل البانر'],
                                                'banner_rotation_speed' => [
                                                    'en' => 'Banner Rotation Speed',
                                                    'ar' => 'سرعة دوران البانر',
                                                ],
                                                'banner_title' => ['en' => 'Banner Title', 'ar' => 'عنوان البانر'],
                                                'banner_description' => [
                                                    'en' => 'Banner Description',
                                                    'ar' => 'وصف البانر',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][en]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                        class="form-control"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][ar]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                        class="form-control" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hero Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-indigo text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-star me-2"></i>
                            Hero Section Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['hero'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'hero_title' => ['en' => 'Hero Title', 'ar' => 'عنوان القسم الرئيسي'],
                                                'hero_subtitle' => [
                                                    'en' => 'Hero Subtitle',
                                                    'ar' => 'العنوان الفرعي للقسم الرئيسي',
                                                ],
                                                'hero_description' => [
                                                    'en' => 'Hero Description',
                                                    'ar' => 'وصف القسم الرئيسي',
                                                ],
                                                'hero_button_text' => [
                                                    'en' => 'Hero Button Text',
                                                    'ar' => 'نص زر القسم الرئيسي',
                                                ],
                                                'hero_image' => ['en' => 'Hero Image', 'ar' => 'صورة القسم الرئيسي'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][en]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                        class="form-control"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][ar]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                        class="form-control" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Services Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-teal text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-concierge-bell me-2"></i>
                            Services Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['services'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'services_title' => ['en' => 'Services Title', 'ar' => 'عنوان الخدمات'],
                                                'services_description' => [
                                                    'en' => 'Services Description',
                                                    'ar' => 'وصف الخدمات',
                                                ],
                                                'services_button_text' => [
                                                    'en' => 'Services Button Text',
                                                    'ar' => 'نص زر الخدمات',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][en]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                        class="form-control"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                        placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text')
                                                    <input type="text"
                                                        name="multilingual_settings[{{ $setting->key }}][ar]"
                                                        value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                        class="form-control" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                        placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Store Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-orange text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-store me-2"></i>
                            Store Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['store'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'store_title' => ['en' => 'Store Title', 'ar' => 'عنوان المتاجر'],
                                                'store_description' => [
                                                    'en' => 'Store Description',
                                                    'ar' => 'وصف المتاجر',
                                                ],
                                                'store_button_text' => [
                                                    'en' => 'Store Button Text',
                                                    'ar' => 'نص زر المتاجر',
                                                ],
                                                'store_discount' => ['en' => 'Store Discount', 'ar' => 'خصم المتجر'],
                                                'store_banner_text' => [
                                                    'en' => 'Store Banner Text',
                                                    'ar' => 'نص بانر المتجر',
                                                ],
                                                'delivery_info' => ['en' => 'Delivery Info', 'ar' => 'معلومات التوصيل'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Clinics Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-blue text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-clinic-medical me-2"></i>
                            Clinics Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['clinics'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'clinics_button_text' => [
                                                    'en' => 'Clinics Button Text',
                                                    'ar' => 'نص زر العيادات',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dr. Bo Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-pink text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-robot me-2"></i>
                            Dr. Bo Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['dr_bo'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'dr_bo_button_text' => [
                                                    'en' => 'Dr. Bo Button Text',
                                                    'ar' => 'نص زر دكتور بو',
                                                ],
                                                'dr_bo_typing_text' => [
                                                    'en' => 'Dr. Bo Typing Text',
                                                    'ar' => 'نص الكتابة لدكتور بو',
                                                ],
                                                'dr_bo_title' => ['en' => 'Dr. Bo Title', 'ar' => 'عنوان دكتور بو'],
                                                'dr_bo_subtitle' => [
                                                    'en' => 'Dr. Bo Subtitle',
                                                    'ar' => 'عنوان فرعي لدكتور بو',
                                                ],
                                                'dr_bo_description' => [
                                                    'en' => 'Dr. Bo Description',
                                                    'ar' => 'وصف دكتور بو',
                                                ],
                                                'dr_bo_status' => ['en' => 'Dr. Bo Status', 'ar' => 'حالة دكتور بو'],
                                                'dr_bo_example_question' => [
                                                    'en' => 'Dr. Bo Example Question',
                                                    'ar' => 'سؤال مثال لدكتور بو',
                                                ],
                                                'dr_bo_example_answer' => [
                                                    'en' => 'Dr. Bo Example Answer',
                                                    'ar' => 'إجابة مثال لدكتور بو',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pet Posts Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-cyan text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-paw me-2"></i>
                            Pet Posts Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['pet_posts'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'pet_posts_description' => [
                                                    'en' => 'Pet Posts Description',
                                                    'ar' => 'وصف منشورات الحيوانات الأليفة',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stats Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-lime text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            Statistics Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['stats'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'stats_rating' => ['en' => 'Stats Rating', 'ar' => 'التقييم الإحصائي'],
                                                'stats_users' => ['en' => 'Stats Users', 'ar' => 'المستخدمين الإحصائي'],
                                                'stats_clinics' => [
                                                    'en' => 'Stats Clinics',
                                                    'ar' => 'العيادات الإحصائية',
                                                ],
                                                'stats_support' => ['en' => 'Stats Support', 'ar' => 'الدعم الإحصائي'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- About Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-brown text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            About Us Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['about'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'about_intro' => ['en' => 'About Intro', 'ar' => 'مقدمة عنا'],
                                                'about_description' => ['en' => 'About Description', 'ar' => 'وصف عنا'],
                                                'about_mission' => ['en' => 'About Mission', 'ar' => 'مهمتنا'],
                                                'about_us_image' => ['en' => 'About Us Image', 'ar' => 'صورة عنا'],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @elseif($setting->type === 'image')
                                            <div class="d-flex align-items-center">
                                                @if ($setting->value)
                                                    <div class="me-3">
                                                        <img src="{{ Storage::url($setting->value) }}"
                                                            alt="{{ $setting->key }}" class="img-thumbnail"
                                                            style="max-height: 80px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="settings[{{ $setting->key }}]"
                                                    class="form-control">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Settings -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-gray text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-shoe-prints me-2"></i>
                            Footer Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($settings['footer'] ?? [] as $setting)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        @php
                                            $label = [
                                                'footer_description' => [
                                                    'en' => 'Footer Description',
                                                    'ar' => 'وصف الفوتر',
                                                ],
                                                'footer_banner_image' => [
                                                    'en' => 'Footer Banner Image',
                                                    'ar' => 'صورة بانر الفوتر',
                                                ],
                                            ][$setting->key] ?? [
                                                'en' => ucfirst(str_replace('_', ' ', $setting->key)),
                                                'ar' => ucfirst(str_replace('_', ' ', $setting->key)),
                                            ];
                                        @endphp
                                        <span class="d-block">{{ $label['en'] }}</span>
                                        <small class="text-muted d-block">{{ $label['ar'] }}</small>
                                        @if ($setting->is_multilingual)
                                            <span class="badge bg-primary ms-2">Multilingual</span>
                                        @endif
                                    </label>
                                    @if ($setting->description)
                                        <small class="form-text text-muted d-block">{{ $setting->description }}</small>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->is_multilingual)
                                        <!-- Multilingual Input -->
                                        <div class="nav nav-tabs mb-3" role="tablist">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-en" type="button" role="tab">
                                                English
                                            </button>
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#{{ $setting->key }}-ar" type="button" role="tab">
                                                العربية
                                            </button>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="{{ $setting->key }}-en"
                                                role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['en'] ?? ''
                                                            : $setting->value;
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][en]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}"
                                                            class="form-control"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][en]" class="form-control" rows="3"
                                                            placeholder="English {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.en", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="tab-pane fade" id="{{ $setting->key }}-ar" role="tabpanel">
                                                @php
                                                    $currentValue =
                                                        $setting->is_multilingual && $setting->value
                                                            ? json_decode($setting->value, true)['ar'] ?? ''
                                                            : '';
                                                @endphp
                                                @if ($setting->type === 'text' || $setting->type === 'textarea')
                                                    @if ($setting->type === 'text')
                                                        <input type="text"
                                                            name="multilingual_settings[{{ $setting->key }}][ar]"
                                                            value="{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}"
                                                            class="form-control" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">
                                                    @else
                                                        <textarea name="multilingual_settings[{{ $setting->key }}][ar]" class="form-control" rows="3" dir="rtl"
                                                            placeholder="العربية {{ str_replace('_', ' ', $setting->key) }}">{{ old("multilingual_settings.{$setting->key}.ar", $currentValue) }}</textarea>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Single Language Input -->
                                        @if ($setting->type === 'text')
                                            <input type="text" name="settings[{{ $setting->key }}]"
                                                value="{{ old("settings.{$setting->key}", $setting->value) }}"
                                                class="form-control"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}">{{ old("settings.{$setting->key}", $setting->value) }}</textarea>
                                        @elseif($setting->type === 'image')
                                            <div class="d-flex align-items-center">
                                                @if ($setting->value)
                                                    <div class="me-3">
                                                        <img src="{{ Storage::url($setting->value) }}"
                                                            alt="{{ $setting->key }}" class="img-thumbnail"
                                                            style="max-height: 80px;">
                                                    </div>
                                                @endif
                                                <input type="file" name="settings[{{ $setting->key }}]"
                                                    class="form-control">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-paw">
                                <i class="fas fa-save me-2"></i>
                                Save Settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .dynamic-banner-container {
            position: relative;
            z-index: 1;
        }

        .dynamic-banner {
            margin-top: 0;
            position: relative;
            background: #FFD700;
            padding: 16px 0;
            text-align: center;
            font-weight: 700;
            font-size: 18px;
            color: #333;
            overflow: hidden;
            height: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .banner-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            height: 100%;
        }

        .banner-text {
            opacity: 0;
            transform: translateY(10px);
            transition: all .6s ease;
        }

        .banner-text.active {
            opacity: 1;
            transform: translateY(0);
        }

        .banner-cat {
            position: absolute;
            right: 15%;
            top: 100%;
            transform: translateY(100%);
            width: 100px;
            animation: floatCatBanner 6s ease-in-out infinite;
        }

        @keyframes floatCatBanner {

            0%,
            100% {
                transform: translateY(-90%);
            }

            50% {
                transform: translateY(0);
            }
        }

        .page-header {
            background: linear-gradient(135deg, var(--paw-dark), #2C3E50);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .btn-paw {
            background: var(--paw-primary);
            border: 2px solid var(--paw-primary);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-paw:hover {
            background: var(--paw-accent);
            border-color: var(--paw-accent);
            color: var(--paw-primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        /* Additional color classes for settings sections */
        .bg-purple {
            background-color: #6f42c1 !important;
        }

        .bg-indigo {
            background-color: #6610f2 !important;
        }

        .bg-teal {
            background-color: #20c997 !important;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .bg-pink {
            background-color: #e83e8c !important;
        }

        .bg-cyan {
            background-color: #0dcaf0 !important;
        }

        .bg-lime {
            background-color: #84cc16 !important;
        }

        .bg-brown {
            background-color: #8b4513 !important;
        }

        .bg-gray {
            background-color: #6c757d !important;
        }

        .bg-blue {
            background-color: #0d6efd !important;
        }
    </style>
@endsection
