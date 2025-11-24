@extends('admin.layouts.app')

@section('title', 'Contact Submission Details')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Contact Submission Details</h1>
        <a href="{{ route('admin.contactsubmissions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Submissions
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Submission from {{ $contactsubmission->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <p class="mb-0">{{ $contactsubmission->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p class="mb-0">{{ $contactsubmission->email }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <p class="mb-0">{{ $contactsubmission->phone ?? 'Not provided' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong>Submitted:</strong>
                        <p class="mb-0">{{ $contactsubmission->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <strong>Message:</strong>
                <div class="border rounded p-3 bg-light">
                    {{ $contactsubmission->message }}
                </div>
            </div>

            <div class="d-flex gap-2">
                @if (!$contactsubmission->is_read)
                    <form action="{{ route('admin.contactsubmissions.mark-read', $contactsubmission) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-2"></i>Mark as Read
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.contactsubmissions.mark-unread', $contactsubmission) }}" method="POST"
                        class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-envelope me-2"></i>Mark as Unread
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.contactsubmissions.destroy', $contactsubmission) }}" method="POST"
                    class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this submission?')">
                        <i class="fas fa-trash me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
