@extends('admin.layouts.app')

@section('title', 'Manage Services')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-concierge-bell me-2"></i>
                    Manage Services
                </h1>
                <p class="text-muted mb-0">Manage all pet care services offered by the platform</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Service
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body text-center">
                    <i class="fas fa-concierge-bell stat-icon"></i>
                    <div class="stat-number">{{ $services->count() }}</div>
                    <div class="stat-label">Total Services</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $services->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Services</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-pause-circle stat-icon"></i>
                    <div class="stat-number">{{ $services->where('is_active', false)->count() }}</div>
                    <div class="stat-label">Inactive Services</div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Services List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Icon</th>
                            <th width="20%">Name</th>
                            <th width="30%">Description</th>
                            <th width="15%">Slug</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <i class="{{ $service->icon }} fa-2x text-primary"></i>
                                </td>
                                <td>
                                    <strong>{{ $service->name }}</strong>
                                </td>
                                <td>{{ Str::limit($service->description, 50) }}</td>
                                <td>
                                    <code class="text-muted">{{ $service->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                        <i class="fas fa-{{ $service->is_active ? 'check' : 'times' }} me-1"></i>
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.services.edit', $service) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this service?')"
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
