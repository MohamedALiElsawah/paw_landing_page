@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-4 mb-4">
        <div>
            <h1 class="h2 mb-1" style="color: var(--paw-dark);">Welcome to PawApp Admin</h1>
            <p class="text-muted mb-0">Manage your pet care platform with ease</p>
        </div>
        <div class="d-flex align-items-center">
            <div class="me-3">
                <small class="text-muted">Last login</small>
                <div class="fw-bold">{{ now()->format('M j, Y g:i A') }}</div>
            </div>
            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                style="width: 50px; height: 50px;">
                <i class="fas fa-paw text-white"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card clinics">
                <div class="stat-icon">
                    <i class="fas fa-clinic-medical"></i>
                </div>
                <div class="stat-number">{{ $stats['clinics'] }}</div>
                <div class="stat-label">Veterinary Clinics</div>
                <div class="mt-3">
                    <a href="{{ route('admin.clinics.index') }}" class="text-white text-decoration-none">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stores">
                <div class="stat-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stat-number">{{ $stats['stores'] }}</div>
                <div class="stat-label">Pet Stores</div>
                <div class="mt-3">
                    <a href="{{ route('admin.stores.index') }}" class="text-white text-decoration-none">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card posts">
                <div class="stat-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stat-number">{{ $stats['petPosts'] }}</div>
                <div class="stat-label">Pet Posts</div>
                <div class="mt-3">
                    <a href="{{ route('admin.petposts.index') }}" class="text-white text-decoration-none">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card reviews">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number">{{ $stats['reviews'] }}</div>
                <div class="stat-label">Customer Reviews</div>
                <div class="mt-3">
                    <a href="{{ route('admin.reviews.index') }}" class="text-white text-decoration-none">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card partners">
                <div class="stat-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stat-number">{{ $stats['partners'] }}</div>
                <div class="stat-label">Partners</div>
                <div class="mt-3">
                    <a href="{{ route('admin.partners.index') }}" class="text-white text-decoration-none">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card contacts">
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-number">{{ $stats['contactSubmissions'] }}</div>
                <div class="stat-label">New Messages</div>
                <div class="mt-3">
                    <a href="{{ route('admin.contactsubmissions.index') }}" class="text-decoration-none"
                        style="color: inherit;">
                        <small>View All <i class="fas fa-arrow-right ms-1"></i></small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <h5 class="card-title mb-3" style="color: var(--paw-dark);">
                        <i class="fas fa-bolt me-2" style="color: var(--paw-accent);"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.clinics.create') }}" class="btn btn-paw w-100">
                                <i class="fas fa-plus me-2"></i>Add Clinic
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.stores.create') }}" class="btn btn-paw w-100">
                                <i class="fas fa-plus me-2"></i>Add Store
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.petposts.create') }}" class="btn btn-paw w-100">
                                <i class="fas fa-plus me-2"></i>Add Post
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.services.create') }}" class="btn btn-paw w-100">
                                <i class="fas fa-plus me-2"></i>Add Service
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.clinics.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list me-2"></i>Manage Clinics
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.stores.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list me-2"></i>Manage Stores
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.petposts.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list me-2"></i>Manage Posts
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-list me-2"></i>Manage Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom-0 pb-0">
                    <h5 class="card-title mb-3" style="color: var(--paw-dark);">
                        <i class="fas fa-history me-2" style="color: var(--paw-secondary);"></i>
                        Recent Activity
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <div>
                                <i class="fas fa-clinic-medical text-primary me-2"></i>
                                <span>New clinic "Paws & Claws" was added</span>
                            </div>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <div>
                                <i class="fas fa-star text-warning me-2"></i>
                                <span>5 new reviews received</span>
                            </div>
                            <small class="text-muted">5 hours ago</small>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <div>
                                <i class="fas fa-envelope text-info me-2"></i>
                                <span>3 new contact messages</span>
                            </div>
                            <small class="text-muted">1 day ago</small>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                            <div>
                                <i class="fas fa-handshake text-success me-2"></i>
                                <span>New partner "Pet Paradise" joined</span>
                            </div>
                            <small class="text-muted">2 days ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
