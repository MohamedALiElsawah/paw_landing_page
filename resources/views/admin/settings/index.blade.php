@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
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
    </div>

    <style>
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
    </style>
@endsection
