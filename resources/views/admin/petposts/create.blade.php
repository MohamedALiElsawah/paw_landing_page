@extends('admin.layouts.app')

@section('title', 'Create Pet Post')

@section('content')
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-paw me-2"></i>
                    Create Pet Post
                </h1>
                <p class="text-muted mb-0">Add a new pet care article or story</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.petposts.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Pet Posts
                </a>
            </div>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>
                Pet Post Information
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.petposts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title_en" class="form-label fw-bold">Title (English) *</label>
                            <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                                id="title_en" name="title_en" value="{{ old('title_en') }}"
                                placeholder="Enter post title in English" required>
                            @error('title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title_ar" class="form-label fw-bold">Title (Arabic) *</label>
                            <input type="text" class="form-control @error('title_ar') is-invalid @enderror"
                                id="title_ar" name="title_ar" value="{{ old('title_ar') }}"
                                placeholder="أدخل عنوان المنشور بالعربية" dir="rtl" required>
                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="content_en" class="form-label fw-bold">Content (English) *</label>
                            <textarea class="form-control @error('content_en') is-invalid @enderror" id="content_en" name="content_en"
                                rows="5" placeholder="Enter post content in English" required>{{ old('content_en') }}</textarea>
                            @error('content_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="content_ar" class="form-label fw-bold">Content (Arabic) *</label>
                            <textarea class="form-control @error('content_ar') is-invalid @enderror" id="content_ar" name="content_ar"
                                rows="5" dir="rtl" placeholder="أدخل محتوى المنشور بالعربية" required>{{ old('content_ar') }}</textarea>
                            @error('content_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Post Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <div class="form-text">
                                Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="published_at" class="form-label fw-bold">Publish Date</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                                id="published_at" name="published_at"
                                value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            <div class="form-text">
                                Leave empty to publish immediately
                            </div>
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                            checked>
                        <label class="form-check-label fw-bold" for="is_published">
                            Publish Post
                        </label>
                        <div class="form-text">
                            Uncheck to save as draft
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.petposts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-paw">
                        <i class="fas fa-save me-2"></i>
                        Create Post
                    </button>
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
