@extends('admin.layout.master')
@section('title', 'Job Applications')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="mb-1 fw-bold text-dark">Job Applications</h2>
            <p class="text-muted mb-0">Manage all job applications on your platform</p>
        </div>
    </div>
    <div class="row g-4">
        @forelse($jobApplications as $application)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm position-relative">
                    <div class="card-body d-flex flex-column align-items-center text-center p-4">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                            <i class="bi bi-person-lines-fill fs-2 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1 text-dark">{{ $application->applicant_name }}</h5>
                        <div class="text-muted small mb-2">{{ $application->applicant_email }}</div>
                        <div class="mb-2"><span class="badge bg-info">{{ $application->jobPosting->title ?? '-' }}</span></div>
                        <div class="mb-2"><span class="badge bg-secondary">{{ $application->applied_at ? $application->applied_at->format('Y-m-d') : '-' }}</span></div>
                        <div class="mb-2"><span class="badge bg-success">{{ $application->status ?? '-' }}</span></div>
                        <div class="d-flex gap-2 justify-content-center mt-2">
                            <a href="{{ route('admin.job_applications.show', $application->id) }}" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-person-lines-fill" style="font-size: 2rem;"></i>
                    <p class="mt-2">No job applications found.</p>
                </div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $jobApplications->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
