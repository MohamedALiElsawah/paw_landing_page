@extends('admin.layouts.app')

@section('title', 'Create Store')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Store</h1>
        <a href="{{ route('admin.stores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Stores
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.stores.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_en" class="form-label">Store Name (English)</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                   id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Store Name (Arabic)</label>
                            <input type="text" class="form-control @error('name_ar') is-invalid @enderror"
                                   id="name_ar" name="name_ar" value="{{ old('name_ar') }}" required dir="rtl">
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location_en" class="form-label">Location (English)</label>
                            <input type="text" class="form-control @error('location_en') is-invalid @enderror"
                                   id="location_en" name="location_en" value="{{ old('location_en') }}" required>
                            @error('location_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location_ar" class="form-label">Location (Arabic)</label>
                            <input type="text" class="form-control @error('location_ar') is-invalid @enderror"
                                   id="location_ar" name="location_ar" value="{{ old('location_ar') }}" required dir="rtl">
                            @error('location_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating (0-5)</label>
                            <input type="number" class="form-control @error('rating') is-invalid @enderror"
                                   id="rating" name="rating" value="{{ old('rating', 0) }}" min="0" max="5" step="0.1">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="working_hours_en" class="form-label">Working Hours (English)</label>
                            <input type="text" class="form-control @error('working_hours_en') is-invalid @enderror"
                                   id="working_hours_en" name="working_hours_en" value="{{ old('working_hours_en') }}" required>
                            @error('working_hours_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="working_hours_ar" class="form-label">Working Hours (Arabic)</label>
                            <input type="text" class="form-control @error('working_hours_ar') is-invalid @enderror"
                                   id="working_hours_ar" name="working_hours_ar" value="{{ old('working_hours_ar') }}" required dir="rtl">
                            @error('working_hours_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                   id="logo" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Store Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Create Store
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
