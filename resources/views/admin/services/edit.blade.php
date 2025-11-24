@extends('admin.layouts.app')

@section('title', 'Edit Service')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Service</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Services
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_en" class="form-label">Service Name (English)</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                name="name_en" value="{{ old('name_en', $service->getTranslation('name', 'en')) }}"
                                required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Service Name (Arabic)</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar" value="{{ old('name_ar', $service->getTranslation('name', 'ar')) }}" required
                                dir="rtl">
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                                rows="3" required>{{ old('description_en', $service->getTranslation('description', 'en')) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">Description (Arabic)</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar"
                                rows="3" required dir="rtl">{{ old('description_ar', $service->getTranslation('description', 'ar')) }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Font Awesome Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon" value="{{ old('icon', $service->icon) }}" placeholder="fas fa-paw" required>
                            <small class="form-text text-muted">
                                Enter Font Awesome icon class (e.g., fas fa-paw, fas fa-heart, fas fa-stethoscope)
                            </small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Service
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
