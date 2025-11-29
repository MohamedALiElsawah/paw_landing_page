@extends('admin.layouts.app')

@section('title', 'Create Partner')

@section('content')
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-handshake me-2"></i>
                    Create Partner
                </h1>
                <p class="text-muted mb-0">Add a new partner to your website</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Partners
                </a>
            </div>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>
                Partner Information
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_en" class="form-label fw-bold">Name (English) *</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                name="name_en" value="{{ old('name_en') }}" placeholder="Enter partner name in English"
                                required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_ar" class="form-label fw-bold">Name (Arabic) *</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar" value="{{ old('name_ar') }}" placeholder="أدخل اسم الشريك بالعربية"
                                dir="rtl" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="logo" class="form-label fw-bold">Logo *</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo"
                                name="logo" accept="image/*" required>
                            <div class="form-text">
                                Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="order" class="form-label fw-bold">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order', 0) }}" placeholder="Enter display order"
                                min="0">
                            <div class="form-text">
                                Lower numbers appear first. Default: 0
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            checked>
                        <label class="form-check-label fw-bold" for="is_active">
                            Active Partner
                        </label>
                        <div class="form-text">
                            Uncheck to hide this partner from the website
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-paw">
                        <i class="fas fa-save me-2"></i>
                        Create Partner
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
