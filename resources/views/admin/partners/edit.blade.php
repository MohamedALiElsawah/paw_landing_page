@extends('admin.layouts.app')

@section('title', 'Edit Partner')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Partner</h1>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Partners
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        @if ($partner->logo)
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label>
                                <div>
                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }} Logo"
                                        style="max-width: 150px; height: auto;" class="rounded border">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">English Information</h5>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">Partner Name (English)</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                name="name_en" value="{{ old('name_en', $partner->getRawOriginal('name')['en'] ?? '') }}"
                                required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description_en" class="form-label">Description (English)</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                                rows="3">{{ old('description_en', $partner->getRawOriginal('description')['en'] ?? '') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Arabic Information</h5>

                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Partner Name (Arabic)</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar" value="{{ old('name_ar', $partner->getRawOriginal('name')['ar'] ?? '') }}"
                                required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description_ar" class="form-label">Description (Arabic)</label>
                            <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar"
                                rows="3" dir="rtl">{{ old('description_ar', $partner->getRawOriginal('description')['ar'] ?? '') }}</textarea>
                            @error('description_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="website" class="form-label">Website URL</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website"
                                name="website" value="{{ old('website', $partner->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order', $partner->order) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Lower numbers appear first</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Partner Logo</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                        name="logo" accept="image/*">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Leave empty to keep current logo. Recommended size: 200x100px</div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            {{ $partner->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
