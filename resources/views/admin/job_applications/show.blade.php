@extends('admin.layout.master')
@section('title', 'Job Application Details')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-person-lines-fill fs-3 me-3"></i>
                    <div>
                        <h3 class="mb-0">Application for {{ $jobApplication->jobPosting->title ?? '-' }}</h3>
                        <div class="small text-white-50">{{ $jobApplication->applicant_name }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-info me-2">{{ $jobApplication->status ?? '-' }}</span>
                        <span class="badge bg-secondary">{{ $jobApplication->applied_at ? $jobApplication->applied_at->format('Y-m-d H:i') : '-' }}</span>
                    </div>
                    <p class="mb-2"><strong>Email:</strong> {{ $jobApplication->applicant_email }}</p>
                    <p class="mb-2"><strong>Cover Letter:</strong></p>
                    <div class="border p-2 mb-2">{{ $jobApplication->cover_letter }}</div>
                    @if($jobApplication->resume_path)
                        <a href="{{ asset('storage/' . $jobApplication->resume_path) }}" class="btn btn-outline-secondary" target="_blank">View Resume</a>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('admin.job_applications.index') }}" class="btn btn-outline-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
