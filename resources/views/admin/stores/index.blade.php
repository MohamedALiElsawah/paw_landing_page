@extends('admin.layouts.app')

@section('title', 'Manage Stores')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-store me-2"></i>
                    Manage Stores
                </h1>
                <p class="text-muted mb-0">Manage all pet stores and suppliers in the system</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.stores.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Store
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card stores">
                <div class="card-body text-center">
                    <i class="fas fa-store stat-icon"></i>
                    <div class="stat-number">{{ $stores->count() }}</div>
                    <div class="stat-label">Total Stores</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $stores->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Stores</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-pause-circle stat-icon"></i>
                    <div class="stat-number">{{ $stores->where('is_active', false)->count() }}</div>
                    <div class="stat-label">Inactive Stores</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body text-center">
                    <i class="fas fa-star stat-icon"></i>
                    <div class="stat-number">{{ $stores->avg('rating') ? number_format($stores->avg('rating'), 1) : '0.0' }}
                    </div>
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
                Stores List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Logo</th>
                            <th width="10%">Image</th>
                            <th width="20%">Name</th>
                            <th width="15%">Location</th>
                            <th width="15%">Phone</th>
                            <th width="10%">Rating</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stores as $store)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($store->logo)
                                        <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-store text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($store->image)
                                        <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $store->name }}</strong>
                                </td>
                                <td>{{ $store->location }}</td>
                                <td>
                                    <a href="tel:{{ $store->phone }}" class="text-decoration-none">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $store->phone }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i>{{ $store->rating }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $store->is_active ? 'success' : 'danger' }}">
                                        <i class="fas fa-{{ $store->is_active ? 'check' : 'times' }} me-1"></i>
                                        {{ $store->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.stores.edit', $store) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.stores.destroy', $store) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this store?')"
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
