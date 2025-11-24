@extends('admin.layouts.app')

@section('title', 'Manage Partners')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-handshake me-2"></i>
                    Manage Partners
                </h1>
                <p class="text-muted mb-0">Manage all business partners and collaborators</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Partner
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card partners">
                <div class="card-body text-center">
                    <i class="fas fa-handshake stat-icon"></i>
                    <div class="stat-number">{{ $partners->count() }}</div>
                    <div class="stat-label">Total Partners</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $partners->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Partners</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-pause-circle stat-icon"></i>
                    <div class="stat-number">{{ $partners->where('is_active', false)->count() }}</div>
                    <div class="stat-label">Inactive Partners</div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Partners List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Logo</th>
                            <th width="35%">Name</th>
                            <th width="15%">Order</th>
                            <th width="15%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                            style="width: 50px; height: 50px; object-fit: contain;" class="rounded">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-handshake text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $partner->name }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $partner->order }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $partner->is_active ? 'success' : 'danger' }}">
                                        <i class="fas fa-{{ $partner->is_active ? 'check' : 'times' }} me-1"></i>
                                        {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.partners.edit', $partner) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this partner?')"
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
