@extends('admin.layouts.app')

@section('title', 'Contact Submissions')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-envelope me-2"></i>
                    Contact Submissions
                </h1>
                <p class="text-muted mb-0">Manage all contact form submissions from website visitors</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card contacts">
                <div class="card-body text-center">
                    <i class="fas fa-envelope stat-icon"></i>
                    <div class="stat-number">{{ $submissions->count() }}</div>
                    <div class="stat-label">Total Submissions</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $submissions->where('is_read', true)->count() }}</div>
                    <div class="stat-label">Read</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-envelope-open stat-icon"></i>
                    <div class="stat-number">{{ $submissions->where('is_read', false)->count() }}</div>
                    <div class="stat-label">Unread</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body text-center">
                    <i class="fas fa-phone stat-icon"></i>
                    <div class="stat-number">{{ $submissions->whereNotNull('phone')->count() }}</div>
                    <div class="stat-label">With Phone</div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Contact Submissions List
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Phone</th>
                            <th width="25%">Message</th>
                            <th width="10%">Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submissions as $submission)
                            <tr class="{{ $submission->is_read ? '' : 'table-warning' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $submission->name }}</strong>
                                </td>
                                <td>
                                    <a href="mailto:{{ $submission->email }}" class="text-decoration-none">
                                        <i class="fas fa-envelope me-1"></i>
                                        {{ $submission->email }}
                                    </a>
                                </td>
                                <td>
                                    @if ($submission->phone)
                                        <a href="tel:{{ $submission->phone }}" class="text-decoration-none">
                                            <i class="fas fa-phone me-1"></i>
                                            {{ $submission->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($submission->message, 50) }}</td>
                                <td>
                                    <small class="text-muted">{{ $submission->created_at->format('M d, Y H:i') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $submission->is_read ? 'success' : 'warning' }}">
                                        <i class="fas fa-{{ $submission->is_read ? 'check' : 'envelope' }} me-1"></i>
                                        {{ $submission->is_read ? 'Read' : 'Unread' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contactsubmissions.show', $submission) }}"
                                            class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($submission->is_read)
                                            <form action="{{ route('admin.contactsubmissions.mark-unread', $submission) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-warning"
                                                    data-bs-toggle="tooltip" title="Mark Unread">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.contactsubmissions.mark-read', $submission) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success"
                                                    data-bs-toggle="tooltip" title="Mark Read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.contactsubmissions.destroy', $submission) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this submission?')"
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

        .table-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
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
