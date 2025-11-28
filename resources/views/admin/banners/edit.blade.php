@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-edit me-2"></i>
                    Edit Banner
                </h1>
                <p class="text-muted mb-0">Update banner details</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Banners
                </a>
            </div>
        </div>
    </div>

    <!-- Banner Form -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-edit me-2"></i>
                Banner Details
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Language Tabs -->
                <div class="nav nav-tabs mb-4" role="tablist">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#english-tab" type="button"
                        role="tab">
                        English Content
                    </button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#arabic-tab" type="button"
                        role="tab">
                        العربية
                    </button>
                </div>

                <div class="tab-content">
                    <!-- English Tab -->
                    <div class="tab-pane fade show active" id="english-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">Title (English) *</label>
                                    <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                        id="title_en" name="title_en" value="{{ old('title_en', $banner->title_en) }}"
                                        required>
                                    @error('title_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="button_text_en" class="form-label">Button Text (English)</label>
                                    <input type="text" class="form-control @error('button_text_en') is-invalid @enderror"
                                        id="button_text_en" name="button_text_en"
                                        value="{{ old('button_text_en', $banner->button_text_en) }}">
                                    @error('button_text_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description (English) *</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                                rows="4" required>{{ old('description_en', $banner->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Arabic Tab -->
                    <div class="tab-pane fade" id="arabic-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_ar" class="form-label">العنوان (العربية) *</label>
                                    <input type="text" class="form-control @error('title_ar') is-invalid @enderror"
                                        id="title_ar" name="title_ar" value="{{ old('title_ar', $banner->title_ar) }}"
                                        dir="rtl" required>
                                    @error('title_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="button_text_ar" class="form-label">نص الزر (العربية)</label>
                                    <input type="text" class="form-control @error('button_text_ar') is-invalid @enderror"
                                        id="button_text_ar" name="button_text_ar"
                                        value="{{ old('button_text_ar', $banner->button_text_ar) }}" dir="rtl">
                                    @error('button_text_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description_ar" class="form-label">الوصف (العربية) *</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar"
                                rows="4" dir="rtl" required>{{ old('description_ar', $banner->description_ar) }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Common Fields -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Banner Image</label>
                            @if ($banner->image_url)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($banner->image_url) ?: $banner->image_url }}"
                                        alt="{{ $banner->title_en }}" style="max-width: 200px; height: auto;"
                                        class="rounded border">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Optional. If not provided, will use default hero image. Recommended size: 1200x400px
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="button_url" class="form-label">Button URL</label>
                            <input type="url" class="form-control @error('button_url') is-invalid @enderror"
                                id="button_url" name="button_url" value="{{ old('button_url', $banner->button_url) }}"
                                placeholder="https://...">
                            @error('button_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                id="order" name="order" value="{{ old('order', $banner->order) }}"
                                min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Lower numbers appear first</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-paw">
                                <i class="fas fa-save me-2"></i>
                                Update Banner
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
