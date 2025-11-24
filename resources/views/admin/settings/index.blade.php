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
