@extends('admin.layouts.app')

@section('title', 'Create Review')

@section('content')
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-star me-2"></i>
                    Create Review
                </h1>
                <p class="text-muted mb-0">Add a new customer review</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Reviews
                </a>
            </div>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus-circle me-2"></i>
                Review Information
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reviewer_name_en" class="form-label fw-bold">Reviewer Name (English) *</label>
                            <input type="text" class="form-control @error('reviewer_name_en') is-invalid @enderror"
                                id="reviewer_name_en" name="reviewer_name_en" value="{{ old('reviewer_name_en') }}"
                                placeholder="Enter reviewer name in English" required>
                            @error('reviewer_name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reviewer_name_ar" class="form-label fw-bold">Reviewer Name (Arabic) *</label>
                            <input type="text" class="form-control @error('reviewer_name_ar') is-invalid @enderror"
                                id="reviewer_name_ar" name="reviewer_name_ar" value="{{ old('reviewer_name_ar') }}"
                                placeholder="أدخل اسم المراجع بالعربية" dir="rtl" required>
                            @error('reviewer_name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="content_en" class="form-label fw-bold">Review Content (English) *</label>
                            <textarea class="form-control @error('content_en') is-invalid @enderror" id="content_en" name="content_en"
                                rows="4" placeholder="Enter review content in English" required>{{ old('content_en') }}</textarea>
                            @error('content_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="content_ar" class="form-label fw-bold">Review Content (Arabic) *</label>
                            <textarea class="form-control @error('content_ar') is-invalid @enderror" id="content_ar" name="content_ar"
                                rows="4" dir="rtl" placeholder="أدخل محتوى المراجعة بالعربية" required>{{ old('content_ar') }}</textarea>
                            @error('content_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="rating" class="form-label fw-bold">Rating *</label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating"
                                required>
                                <option value="">Select Rating</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>★★★★★ (5 Stars)
                                </option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>★★★★☆ (4 Stars)
                                </option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>★★★☆☆ (3 Stars)
                                </option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>★★☆☆☆ (2 Stars)
                                </option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>★☆☆☆☆ (1 Star)</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Review Date *</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                                name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="reviewer_image" class="form-label fw-bold">Reviewer Image</label>
                            <input type="file" class="form-control @error('reviewer_image') is-invalid @enderror"
                                id="reviewer_image" name="reviewer_image" accept="image/*">
                            <div class="form-text">
                                Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                            </div>
                            @error('reviewer_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reviewable_type" class="form-label fw-bold">Review For *</label>
                            <select class="form-control @error('reviewable_type') is-invalid @enderror"
                                id="reviewable_type" name="reviewable_type" required>
                                <option value="">Select Type</option>
                                <option value="clinic" {{ old('reviewable_type') == 'clinic' ? 'selected' : '' }}>Clinic
                                </option>
                                <option value="store" {{ old('reviewable_type') == 'store' ? 'selected' : '' }}>Store
                                </option>
                                <option value="service" {{ old('reviewable_type') == 'service' ? 'selected' : '' }}>
                                    Service</option>
                            </select>
                            @error('reviewable_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reviewable_id" class="form-label fw-bold">Select Item *</label>
                            <select class="form-control @error('reviewable_id') is-invalid @enderror" id="reviewable_id"
                                name="reviewable_id" required>
                                <option value="">Select an item</option>
                            </select>
                            @error('reviewable_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved"
                            value="1" checked>
                        <label class="form-check-label fw-bold" for="is_approved">
                            Approve Review
                        </label>
                        <div class="form-text">
                            Uncheck to save as pending approval
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-paw">
                        <i class="fas fa-save me-2"></i>
                        Create Review
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reviewableTypeSelect = document.getElementById('reviewable_type');
            const reviewableIdSelect = document.getElementById('reviewable_id');

            // Load items based on selected type
            function loadItems(type) {
                reviewableIdSelect.innerHTML = '<option value="">Select an item</option>';

                if (!type) return;

                // Fetch items via AJAX or use data from server
                const items = {
                    'clinic': @json($clinics->map(fn($clinic) => ['id' => $clinic->id, 'name' => $clinic->name])),
                    'store': @json($stores->map(fn($store) => ['id' => $store->id, 'name' => $store->name])),
                    'service': @json($services->map(fn($service) => ['id' => $service->id, 'name' => $service->name]))
                };

                const selectedItems = items[type] || [];

                selectedItems.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = item.name;
                    reviewableIdSelect.appendChild(option);
                });
            }

            // Initial load
            loadItems(reviewableTypeSelect.value);

            // Change event
            reviewableTypeSelect.addEventListener('change', function() {
                loadItems(this.value);
            });
        });
    </script>
@endsection
