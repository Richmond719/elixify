@extends('admin.layout.master')
@section('title', 'Edit Job Posting: ' . $jobPosting->title)
@section('content')

    <div class="page-header mb-3">
        <h2 class="mb-1 fw-bold text-dark">Edit Job Posting: {{ $jobPosting->title }}</h2>
        <p class="text-muted mb-0">Update the job details below.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.job_postings.update', $jobPosting->id) }}" id="jobForm">
                @method('PUT')
                @include('admin.job_postings.form', ['jobPosting' => $jobPosting, 'companies' => $companies])
            </form>
        </div>
    </div>

@endsection
