@extends('admin.layout.master')
@section('title', 'Job Postings')
@section('content')

    <!-- Page Header -->
    <div class="page-header mb-4 d-flex justify-content-between align-items-start gap-3">
        <div>
            <h2 class="mb-1 fw-bold text-dark">Job Postings</h2>
            <p class="text-muted mb-0">Manage all job postings on your platform</p>
        </div>
        <div class="ms-auto">
            <!-- Add Job: visible on all except desktop -->
            <a href="{{ route('admin.job-postings.create') }}" class="btn btn-dark btn-sm d-lg-none align-items-center">
                <i class="bi bi-plus-circle me-2"></i> Add Job
            </a>
            <!-- Add Job: visible only on desktop (large and up) -->
            <a href="{{ route('admin.job-postings.create') }}" class="btn btn-dark btn-sm d-none d-lg-inline-flex align-items-center">
                <i class="bi bi-plus-circle me-2"></i> Add Job
            </a>
        </div>
    </div>
    <div class="row g-4">
        @forelse($jobPostings as $posting)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow position-relative overflow-hidden" style="transition: all 0.3s ease;">
                    <!-- Status Badge -->
                    <div class="position-absolute top-0 end-0 p-2">
                        @if($posting->status === 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($posting->status === 'closed')
                            <span class="badge bg-danger">Closed</span>
                        @else
                            <span class="badge bg-warning">Draft</span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column p-4" style="min-height: 300px;">
                        <!-- Company Name -->
                        <div class="mb-2">
                            <small class="text-muted fw-semibold">{{ $posting->company->name ?? 'No Company' }}</small>
                        </div>

                        <!-- Job Title -->
                        <h5 class="fw-bold mb-3 text-dark" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $posting->title }}
                        </h5>

                        <!-- Location & Classification -->
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark border border-secondary-subtle">
                                <i class="bi bi-geo-alt"></i> {{ $posting->location }}
                            </span>
                            <span class="badge bg-light text-dark border border-secondary-subtle">
                                <i class="bi bi-clock"></i> {{ $posting->classification ?? 'Not specified' }}
                            </span>
                        </div>

                        <!-- Salary (if available) -->
                        @if($posting->salary)
                            <div class="mb-3">
                                <small class="text-muted">Salary Range</small>
                                <div class="fw-semibold text-success">{{ format_ghs($posting->salary) }}</div>
                            </div>
                        @endif

                        <!-- Application Count -->
                        <div class="mb-4 pb-2 border-bottom">
                            <small class="text-muted">Applications</small>
                            <div class="fw-bold text-primary fs-5">{{ $posting->applications?->count() ?? 0 }}</div>
                        </div>

                        <!-- Description Preview -->
                        <p class="text-muted small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ Str::limit($posting->description, 120) }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.job-postings.show', $posting->id) }}" class="btn btn-outline-info btn-sm flex-grow-1">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('admin.job-postings.edit', $posting->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="bi bi-briefcase" style="font-size:3rem;color:#ccc;"></i>
                    <h5 class="text-muted mt-4 fw-bold">No Job Postings Yet</h5>
                    <p class="text-muted mb-4">Start building your job board by creating your first posting.</p>
                    <a href="{{ route('admin.job-postings.create') }}" class="btn btn-dark btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Create First Job Posting
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $jobPostings->links('pagination::bootstrap-5') }}
    </div>

    <!-- Floating Add Button for Mobile only -->
    <a href="{{ route('admin.job-postings.create') }}" class="btn btn-dark rounded-circle shadow-lg position-fixed d-sm-none" style="bottom:2rem;right:2rem;z-index:1050;">
        <i class="bi bi-plus fs-3"></i>
    </a>
@endsection
