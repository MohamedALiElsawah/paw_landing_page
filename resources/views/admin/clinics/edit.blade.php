@extends('admin.layouts.app')

@section('title', 'Edit Clinic')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Clinic</h1>
        <a href="{{ route('admin.clinics.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Clinics
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.clinics.update', $clinic) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        @if ($clinic->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{ asset('storage/' . $clinic->image) }}" alt="{{ $clinic->name }}"
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
                            <label for="name_ar" class="form-label">Clinic Name (Arabic)</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar" value="{{ old('name_ar', $clinic->getTranslation('name', 'ar')) }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location_ar" class="form-label">Location (Arabic)</label>
                            <input type="text" class="form-control @error('location_ar') is-invalid @enderror"
                                id="location_ar" name="location_ar"
                                value="{{ old('location_ar', $clinic->getTranslation('location', 'ar')) }}" required>
                            @error('location_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="working_hours_ar" class="form-label">Working Hours (Arabic)</label>
                            <input type="text" class="form-control @error('working_hours_ar') is-invalid @enderror"
                                id="working_hours_ar" name="working_hours_ar"
                                value="{{ old('working_hours_ar', $clinic->getTranslation('working_hours', 'ar')) }}"
                                required>
                            @error('working_hours_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Arabic Information</h5>

                            <div class="mb-3">
                                <label for="name_ar" class="form-label">Clinic Name (Arabic)</label>
                                <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                    id="name_ar" name="name_ar"
                                    value="{{ old('name_ar', $clinic->getTranslation('name', 'ar')) }}" required>
                                @error('name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="location_ar" class="form-label">Location (Arabic)</label>
                                <input type="text" class="form-control @error('location_ar') is-invalid @enderror"
                                    id="location_ar" name="location_ar"
                                    value="{{ old('location_ar', $clinic->getTranslation('location', 'ar')) }}" required>
                                @error('location_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="working_hours_ar" class="form-label">Working Hours (Arabic)</label>
                                <input type="text" class="form-control @error('working_hours_ar') is-invalid @enderror"
                                    id="working_hours_ar" name="working_hours_ar"
                                    value="{{ old('working_hours_ar', $clinic->getTranslation('working_hours', 'ar')) }}"
                                    required>
                                @error('working_hours_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $clinic->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="distance" class="form-label">Distance (km)</label>
                                <input type="number" step="0.1"
                                    class="form-control @error('distance') is-invalid @enderror" id="distance"
                                    name="distance" value="{{ old('distance', $clinic->distance) }}">
                                @error('distance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Clinic Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Leave empty to keep current image. Recommended size: 400x300px</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                value="1" {{ $clinic->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.clinics.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Clinic
                        </button>
                    </div>
            </form>
        </div>
    </div>
@endsection
