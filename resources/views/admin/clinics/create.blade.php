@extends('admin.layouts.app')

@section('title', 'Add New Clinic')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Clinic</h1>
        <a href="{{ route('admin.clinics.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Clinics
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.clinics.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">English Information</h5>

                        <div class="mb-3">
                            <label for="name_en" class="form-label">Clinic Name (English)</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                name="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location_en" class="form-label">Location (English)</label>
                            <input type="text" class="form-control @error('location_en') is-invalid @enderror"
                                id="location_en" name="location_en" value="{{ old('location_en') }}" required>
                            @error('location_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="working_hours_en" class="form-label">Working Hours (English)</label>
                            <input type="text" class="form-control @error('working_hours_en') is-invalid @enderror"
                                id="working_hours_en" name="working_hours_en" value="{{ old('working_hours_en') }}"
                                required>
                            @error('working_hours_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Arabic Information</h5>

                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Clinic Name (Arabic)</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                name="name_ar" value="{{ old('name_ar') }}" required>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location_ar" class="form-label">Location (Arabic)</label>
                            <input type="text" class="form-control @error('location_ar') is-invalid @enderror"
                                id="location_ar" name="location_ar" value="{{ old('location_ar') }}" required>
                            @error('location_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="working_hours_ar" class="form-label">Working Hours (Arabic)</label>
                            <input type="text" class="form-control @error('working_hours_ar') is-invalid @enderror"
                                id="working_hours_ar" name="working_hours_ar" value="{{ old('working_hours_ar') }}"
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
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" step="0.000001"
                                class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude"
                                value="{{ old('latitude') }}" placeholder="e.g., 29.3340">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" step="0.000001"
                                class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                                name="longitude" value="{{ old('longitude') }}" placeholder="e.g., 48.0760">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror>
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
                    <div class="form-text">Recommended size: 400x300px. Supported formats: JPEG, PNG, GIF</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.clinics.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Create Clinic
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
