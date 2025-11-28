@extends('admin.layouts.app')

@section('title', 'Banners')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-images me-2"></i>
                    Banners
                </h1>
                <p class="text-muted mb-0">Manage scrollable banners for the home page</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.banners.create') }}" class="btn btn-paw">
                    <i class="fas fa-plus me-2"></i>
                    Add New Banner
                </a>
            </div>
        </div>
    </div>

    <!-- Banners Table -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                All Banners
            </h5>
        </div>
        <div class="card-body">
            @if ($banners->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Default</th>
                                <th>Images</th>
                                <th>Title (EN)</th>
                                <th>Title (AR)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->order }}</td>
                                    <td>
                                        @if ($banner->is_default)
                                            <span class="badge bg-success">Default</span>
                                        @else
                                            <form action="{{ route('admin.banners.set-default', $banner->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary"
                                                    title="Set as Default">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-2 align-items-center">
                                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title_en }}"
                                            style="width: 80px; height: 60px; object-fit: cover;" class="rounded border">
                                        @if ($banner->secondary_image_url)
                                            <img src="{{ $banner->secondary_image_url }}" alt="{{ $banner->title_en }}"
                                                style="width: 80px; height: 60px; object-fit: cover;"
                                                class="rounded border">
                                        @endif
                                    </td>
                                    <td>{{ $banner->title_en }}</td>
                                    <td>{{ $banner->title_ar }}</td>
                                    <td>
                                        <form action="{{ route('admin.banners.toggle-status', $banner->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-sm {{ $banner->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this banner?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Banners Found</h4>
                    <p class="text-muted">Create your first banner to get started.</p>
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-paw">
                        <i class="fas fa-plus me-2"></i>
                        Create First Banner
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
