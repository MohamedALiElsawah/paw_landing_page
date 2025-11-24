@extends('admin.layouts.app')

@section('title', 'Manage Reviews')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-star me-2"></i>
                    Manage Reviews
                </h1>
                <p class="text-muted mb-0">Manage all customer reviews and ratings</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Review
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card reviews">
                <div class="card-body text-center">
                    <i class="fas fa-star stat-icon"></i>
                    <div class="stat-number">{{ $reviews->count() }}</div>
                    <div class="stat-label">Total Reviews</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $reviews->where('is_approved', true)->count() }}</div>
                    <div class="stat-label">Approved</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-clock stat-icon"></i>
                    <div class="stat-number">{{ $reviews->where('is_approved', false)->count() }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body text-center">
                    <i class="fas fa-star-half-alt stat-icon"></i>
                    <div class="stat-number">
                        {{ $reviews->avg('rating') ? number_format($reviews->avg('rating'), 1) : '0.0' }}</div>
                    <div class="stat-label">Avg Rating</div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Reviews List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Reviewer</th>
                            <th width="25%">Content</th>
                            <th width="10%">Rating</th>
                            <th width="15%">For</th>
                            <th width="10%">Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($review->reviewer_image)
                                            <img src="{{ asset('storage/' . $review->reviewer_image) }}"
                                                alt="{{ $review->reviewer_name }}"
                                                style="width: 40px; height: 40px; object-fit: cover;"
                                                class="rounded-circle me-2">
                                        @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                        @endif
                                        <span>{{ $review->reviewer_name }}</span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($review->content, 50) }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i>{{ $review->rating }}
                                    </span>
                                </td>
                                <td>
                                    @if ($review->reviewable)
                                        <span class="badge bg-info">
                                            {{ class_basename($review->reviewable_type) }}:
                                            {{ $review->reviewable->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $review->date->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $review->is_approved ? 'success' : 'secondary' }}">
                                        <i class="fas fa-{{ $review->is_approved ? 'check' : 'clock' }} me-1"></i>
                                        {{ $review->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.reviews.edit', $review) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this review?')"
                                                data-bs-toggle="tooltip" title="Delete">
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

        .datatable thead th {
            background: linear-gradient(135deg, var(--paw-dark), #2C3E50) !important;
            color: white !important;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .datatable tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .btn-group .btn {
            border-radius: 8px !important;
            margin: 0 2px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endsection
