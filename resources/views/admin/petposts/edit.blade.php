@extends('admin.layouts.app')

@section('title', 'Edit Pet Post')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pet Post</h1>
        <a href="{{ route('admin.petposts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Pet Posts
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.petposts.update', $petpost) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        @if ($petpost->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{ asset('storage/' . $petpost->image) }}" alt="{{ $petpost->title }}"
                                        style="max-width: 200px; height: auto;" class="rounded border">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">English Information</h5>

                        <div class="mb-3">
                            <label for="title_en" class="form-label">Title (English)</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                id="title_en" name="title_en"
                                value="{{ old('title_en', $petpost->getRawOriginal('title')['en'] ?? '') }}" required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_en" class="form-label">Content (English)</label>
                            <textarea class="form-control @error('content_en') is-invalid @enderror" id="content_en" name="content_en"
                                rows="5" required>{{ old('content_en', $petpost->getRawOriginal('content')['en'] ?? '') }}</textarea>
                            @error('content_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Arabic Information</h5>

                        <div class="mb-3">
                            <label for="title_ar" class="form-label">Title (Arabic)</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror"
                                id="title_ar" name="title_ar"
                                value="{{ old('title_ar', $petpost->getRawOriginal('title')['ar'] ?? '') }}" required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_ar" class="form-label">Content (Arabic)</label>
                            <textarea class="form-control @error('content_ar') is-invalid @enderror" id="content_ar" name="content_ar"
                                rows="5" required dir="rtl">{{ old('content_ar', $petpost->getRawOriginal('content')['ar'] ?? '') }}</textarea>
                            @error('content_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label for="image" class="form-label">Post Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Leave empty to keep current image. Recommended size: 400x300px</div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                            {{ $petpost->is_published ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">Published</label>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.petposts.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
