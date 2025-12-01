@extends('admin.layout.master')
@section('title', 'Job Posting: ' . $jobPosting->title)
@section('content')

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
            <div>
                <h2 class="mb-1 fw-bold text-dark">{{ $jobPosting->title }}</h2>
                <p class="text-muted mb-0"><i class="bi bi-building"></i> {{ $jobPosting->company->name ?? 'No company' }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.job_postings.edit', $jobPosting->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.job_postings.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <!-- Status & Metadata -->
        <div class="d-flex flex-wrap gap-2 align-items-center">
            @if($jobPosting->status === 'active')
                <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle"></i> Active</span>
            @elseif($jobPosting->status === 'closed')
                <span class="badge bg-danger-subtle text-danger"><i class="bi bi-x-circle"></i> Closed</span>
            @else
                <span class="badge bg-warning-subtle text-warning"><i class="bi bi-exclamation-circle"></i> Draft</span>
            @endif
            <span class="badge bg-light text-dark"><i class="bi bi-geo-alt"></i> {{ $jobPosting->location }}</span>
            <span class="badge bg-light text-dark"><i class="bi bi-clock"></i> {{ $jobPosting->classification ?? 'Not specified' }}</span>
            @if($jobPosting->salary)
                <span class="badge bg-light text-dark"><i class="bi bi-currency-dollar"></i> {{ format_ghs($jobPosting->salary) }}</span>
            @endif
        </div>
    </div>

    <!-- Key Stats -->
    <div class="row mb-4 gx-3">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-muted fw-semibold mb-1">Total Applications</div>
                            <div class="display-6 fw-bold text-primary">{{ $jobPosting->applications?->count() ?? 0 }}</div>
                        </div>
                        <div class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="bi bi-people fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-muted fw-semibold mb-1">Date Posted</div>
                            <div class="fs-6 fw-bold text-dark">{{ $jobPosting->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="rounded-circle bg-info-subtle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="bi bi-calendar-event fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-muted fw-semibold mb-1">Last Updated</div>
                            <div class="fs-6 fw-bold text-dark">{{ $jobPosting->updated_at?->format('M d, Y') ?? 'N/A' }}</div>
                        </div>
                        <div class="rounded-circle bg-secondary-subtle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="bi bi-arrow-repeat fs-4 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="small text-muted fw-semibold mb-1">Salary Range</div>
                            <div class="fs-6 fw-bold text-success">{{ $jobPosting->salary ? format_ghs($jobPosting->salary) : 'N/A' }}</div>
                        </div>
                        <div class="rounded-circle bg-success-subtle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                            <i class="bi bi-currency-dollar fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <!-- Job Description -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h6 class="fw-bold mb-0"><i class="bi bi-file-text"></i> Job Description</h6>
                </div>
                <div class="card-body p-4">
                    <p class="text-dark lh-lg" style="white-space: pre-wrap;">{{ $jobPosting->description }}</p>
                </div>
            </div>

            <!-- Job Metadata -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h6 class="fw-bold mb-0"><i class="bi bi-info-circle"></i> Job Details</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted fw-semibold mb-1">Employment Type</div>
                            <p class="text-dark fw-medium">{{ $jobPosting->classification ?? 'Not specified' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted fw-semibold mb-1">Location</div>
                            <p class="text-dark fw-medium">{{ $jobPosting->location }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted fw-semibold mb-1">Company</div>
                            <p class="text-dark fw-medium">{{ $jobPosting->company->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="small text-muted fw-semibold mb-1">Status</div>
                            <p class="text-dark fw-medium">
                                @if($jobPosting->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($jobPosting->status === 'closed')
                                    <span class="badge bg-danger">Closed</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <!-- Recent Applications -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0"><i class="bi bi-file-earmark-check"></i> Recent Applications</h6>
                        <span class="badge bg-primary">{{ $jobPosting->applications?->count() ?? 0 }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @forelse($jobPosting->applications?->take(8) ?? [] as $app)
                        <div class="px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-dark fw-medium small">{{ $app->user->name ?? 'Unknown' }}</div>
                                <div class="text-muted small">{{ $app->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                            </div>
                            <div>
                                @if($app->status === 'accepted')
                                    <span class="badge bg-success text-white">{{ $app->status }}</span>
                                @elseif($app->status === 'rejected')
                                    <span class="badge bg-danger text-white">{{ $app->status }}</span>
                                @else
                                    <span class="badge bg-secondary text-white">{{ $app->status ?? 'Pending' }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.3;"></i>
                            <p class="small mt-2 mb-0">No applications yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
