@extends('admin.layouts.app')

@section('title', 'Manage Clinics')

@section('content')
    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">
                    <i class="fas fa-clinic-medical me-2"></i>
                    Manage Clinics
                </h1>
                <p class="text-muted mb-0">Manage all veterinary clinics in the system</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.clinics.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Clinic
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card clinics">
                <div class="card-body text-center">
                    <i class="fas fa-clinic-medical stat-icon"></i>
                    <div class="stat-number">{{ $clinics->count() }}</div>
                    <div class="stat-label">Total Clinics</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-number">{{ $clinics->where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Clinics</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #fa709a, #fee140);">
                <div class="card-body text-center">
                    <i class="fas fa-pause-circle stat-icon"></i>
                    <div class="stat-number">{{ $clinics->where('is_active', false)->count() }}</div>
                    <div class="stat-label">Inactive Clinics</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <div class="card-body text-center">
                    <i class="fas fa-map-marker-alt stat-icon"></i>
                    <div class="stat-number">{{ $clinics->whereNotNull('latitude')->whereNotNull('longitude')->count() }}
                    </div>
                    <div class="stat-label">With Location</div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable Card -->
    <div class="card card-custom">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                Clinics List
            </h5>
            <div class="card-toolbar">
                <div class="alert alert-info mb-0 py-2 px-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Drag and drop rows to reorder clinics. The order will be reflected on the home page.
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable" style="width:100%" id="clinics-table">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">Order</th>
                            <th width="5%">#</th>
                            <th width="10%">Image</th>
                            <th width="20%">Name</th>
                            <th width="20%">Location</th>
                            <th width="15%">Phone</th>
                            <th width="15%">Coordinates</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($clinics as $clinic)
                            <tr data-id="{{ $clinic->id }}">
                                <td class="sort-handle text-center">
                                    <i class="fas fa-arrows-alt-v text-muted"></i>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($clinic->image)
                                        <img src="{{ asset('storage/' . $clinic->image) }}" alt="{{ $clinic->name }}"
                                            style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-clinic-medical text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $clinic->name }}</strong>
                                </td>
                                <td>{{ $clinic->location }}</td>
                                <td>
                                    <a href="tel:{{ $clinic->phone }}" class="text-decoration-none">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $clinic->phone }}
                                    </a>
                                </td>
                                <td>
                                    @if ($clinic->latitude && $clinic->longitude)
                                        <span class="badge bg-success" data-bs-toggle="tooltip"
                                            title="Lat: {{ $clinic->latitude }}, Lng: {{ $clinic->longitude }}">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            Located
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">No Location</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $clinic->is_active ? 'success' : 'danger' }}">
                                        <i class="fas fa-{{ $clinic->is_active ? 'check' : 'times' }} me-1"></i>
                                        {{ $clinic->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.clinics.edit', $clinic) }}"
                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.clinics.destroy', $clinic) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this clinic?')"
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

        /* Drag and drop styles */
        #sortable tr {
            cursor: move;
        }

        .sort-handle {
            cursor: grab;
        }

        .sort-handle:active {
            cursor: grabbing;
        }

        .ui-sortable-helper {
            background-color: #f8f9fa;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            display: table;
        }

        .ui-sortable-placeholder {
            background-color: #e9ecef;
            visibility: visible !important;
            height: 60px;
        }
    </style>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // Initialize drag and drop sorting
            $("#sortable").sortable({
                handle: ".sort-handle",
                placeholder: "ui-sortable-placeholder",
                update: function(event, ui) {
                    saveNewOrder();
                }
            });

            // Function to save the new order
            function saveNewOrder() {
                var order = [];
                $('#sortable tr').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    url: '{{ route('admin.clinics.reorder') }}',
                    type: 'POST',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update the iteration numbers
                            $('#sortable tr').each(function(index) {
                                $(this).find('td:nth-child(2)').text(index + 1);
                            });

                            // Show success message
                            showToast('Success', 'Clinics order updated successfully.', 'success');
                        }
                    },
                    error: function(xhr) {
                        showToast('Error', 'Failed to update order. Please try again.', 'error');
                    }
                });
            }

            // Toast notification function
            function showToast(title, message, type) {
                // Create toast element
                var toastId = 'toast-' + Date.now();
                var toastHtml = `
                    <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                <strong>${title}:</strong> ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;

                // Add to toast container
                $('.toast-container').remove();
                $('body').append('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
                $('.toast-container').html(toastHtml);

                // Show toast
                var toastEl = document.getElementById(toastId);
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();

                // Remove toast after it's hidden
                toastEl.addEventListener('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection
