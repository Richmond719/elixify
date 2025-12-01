@extends('admin.layout.master')
@section('title', 'Create Company')
@section('content')
    <div class="page-header mb-3">
        <h2 class="mb-1 fw-bold text-dark">Create Company</h2>
        <p class="text-muted mb-0">Fill in the company details below.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('admin.companies.form', [
                'action' => route('admin.companies.store'),
            ])
        </div>
    </div>
@endsection
