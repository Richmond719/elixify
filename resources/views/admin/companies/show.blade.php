@extends('admin.layout.master')
@section('title', 'Company Profile: ' . $company->name)
@section('content')
<div class="container-fluid py-4">
    <!-- Hero / Header -->
    <div class="card bg-white border-0 shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row align-items-start gap-4">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:96px;height:96px;">
                    <i class="bi bi-building fs-1 text-primary"></i>
                </div>
            </div>
            <div class="flex-grow-1">
                <h2 class="mb-1 fw-bold text-dark">{{ $company->name }}</h2>
                <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                    <span class="text-muted"><i class="bi bi-geo-alt me-1"></i> {{ $company->address ?? 'Address not provided' }}</span>
                    <span class="text-muted">•</span>
                    <span class="text-muted"><i class="bi bi-telephone me-1"></i> {{ $company->contact ?? 'No contact listed' }}</span>
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="small ms-2">Visit Website</a>
                    @endif
                </div>
                <div class="mt-2">
                    <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-outline-primary btn-sm me-2">Edit Company</a>
                    <a href="{{ route('admin.job_postings.create') }}?company_id={{ $company->id }}" class="btn btn-dark btn-sm">Post New Job</a>
                </div>
            </div>
            <div class="d-flex gap-2">
                <div class="text-center p-3 bg-light rounded">
                    <div class="h4 mb-0">{{ $company->job_postings->count() }}</div>
                    <small class="text-muted">Jobs</small>
                </div>
                <div class="text-center p-3 bg-light rounded">
                    <div class="h4 mb-0">{{ $company->job_applications->count() }}</div>
                    <small class="text-muted">Applications</small>
                </div>
                <div class="text-center p-3 bg-light rounded">
                    <div class="h4 mb-0">{{ $company->job_postings->where('created_at', '>=', now()->subMonth())->count() }}</div>
                    <small class="text-muted">New (30d)</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Company Info</h6>
                    <p class="mb-1"><strong>Website:</strong>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank">{{ \Illuminate\Support\Str::limit($company->website, 40) }}</a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </p>
                    <hr>
                    <h6 class="fw-bold mb-2">Tags</h6>
                    <div class="mb-2">
                        @foreach($company->tags ?? [] as $tag)
                            <span class="badge bg-light text-dark me-1">{{ $tag }}</span>
                        @endforeach
                        @if(empty($company->tags))
                            <div class="text-muted small">No tags</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="d-flex align-items-baseline justify-content-between mb-2">
                <h5 class="mb-0 fw-bold">Recent Job Postings</h5>
                <small class="text-muted">Showing latest 6</small>
            </div>

            <div class="row g-3">
                @forelse($company->job_postings->sortByDesc('created_at')->take(6) as $posting)
                    <div class="col-12">
                        <div class="card job-card h-100 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column flex-md-row align-items-start gap-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <div>
                                            <h6 class="mb-1 fw-bold">{{ $posting->title }}</h6>
                                            <div class="small text-muted">{{ $posting->location }}</div>
                                        </div>
                                        <div class="text-end small text-muted">{{ $posting->created_at ? $posting->created_at->format('M d') : 'N/A' }}</div>
                                    </div>
                                    <p class="mb-2 text-muted small">{{ \Illuminate\Support\Str::limit($posting->summary ?? $posting->description ?? '', 140) }}</p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="badge bg-light text-dark border">{{ $posting->classification ?? 'Not specified' }}</span>
                                        @if($posting->salary)
                                            <span class="badge bg-success">{{ $posting->salary }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="small text-muted mb-2">{{ $posting->applications->count() }} applications</div>
                                    <a href="{{ route('admin.job_postings.show', $posting->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-4 text-center text-muted">No job postings found.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
