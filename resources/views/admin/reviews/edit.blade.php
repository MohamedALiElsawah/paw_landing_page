@extends('admin.layouts.app')

@section('title', 'Edit Review')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Review</h1>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Reviews
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        @if ($review->reviewer_image)
                            <div class="mb-3">
                                <label class="form-label">Current Reviewer Image</label>
                                <div>
                                    <img src="{{ asset('storage/' . $review->reviewer_image) }}"
                                        alt="{{ $review->reviewer_name }}"
                                        style="max-width: 100px; height: 100px; object-fit: cover;"
                                        class="rounded-circle border">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">English Information</h5>

                        <div class="mb-3">
                            <label for="reviewer_name_en" class="form-label">Reviewer Name (English)</label>
                            <input type="text" class="form-control @error('reviewer_name_en') is-invalid @enderror"
                                id="reviewer_name_en" name="reviewer_name_en"
                                value="{{ old('reviewer_name_en', $review->getTranslation('reviewer_name', 'en')) }}"
                                required>
                            @error('reviewer_name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_en" class="form-label">Review Content (English)</label>
                            <textarea class="form-control @error('content_en') is-invalid @enderror" id="content_en" name="content_en"
                                rows="4" required>{{ old('content_en', $review->getTranslation('content', 'en')) }}</textarea>
                            @error('content_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Arabic Information</h5>

                        <div class="mb-3">
                            <label for="reviewer_name_ar" class="form-label">Reviewer Name (Arabic)</label>
                            <input type="text" class="form-control @error('reviewer_name_ar') is-invalid @enderror"
                                id="reviewer_name_ar" name="reviewer_name_ar"
                                value="{{ old('reviewer_name_ar', $review->getTranslation('reviewer_name', 'ar')) }}"
                                required dir="rtl">
                            @error('reviewer_name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_ar" class="form-label">Review Content (Arabic)</label>
                            <textarea class="form-control @error('content_ar') is-invalid @enderror" id="content_ar" name="content_ar"
                                rows="4" required dir="rtl">{{ old('content_ar', $review->getTranslation('content', 'ar')) }}</textarea>
                            @error('content_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">Review Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" value="{{ old('date', $review->date) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating"
                                required>
                                <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>★★★★★
                                    (5)</option>
                                <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>★★★★☆
                                    (4)</option>
                                <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>★★★☆☆
                                    (3)</option>
                                <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>★★☆☆☆
                                    (2)</option>
                                <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>★☆☆☆☆
                                    (1)</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reviewer_image" class="form-label">Reviewer Image</label>
                            <input type="file" class="form-control @error('reviewer_image') is-invalid @enderror"
                                id="reviewer_image" name="reviewer_image" accept="image/*">
                            @error('reviewer_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to keep current image. Recommended size: 100x100px</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved" value="1"
                            {{ $review->is_approved ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_approved">Approved</label>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
