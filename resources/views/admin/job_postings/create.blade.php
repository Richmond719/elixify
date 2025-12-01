@extends('admin.layout.master')
@section('title', 'Create Job Posting')
@section('content')

    <div class="page-header mb-3">
        <h2 class="mb-1 fw-bold text-dark">Create Job Posting</h2>
        <p class="text-muted mb-0">Fill in the job details below.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.job_postings.store') }}" id="jobForm">
                @include('admin.job_postings.form', [
                    'jobPosting' => (object)['title' => '', 'company_id' => '', 'location' => '', 'salary' => '', 'classification' => '', 'description' => '', 'status' => 'active'],
                    'companies' => $companies
                ])
            </form>
        </div>
    </div>

@endsection
