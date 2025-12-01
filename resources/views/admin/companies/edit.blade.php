@extends('admin.layout.master')
@section('title', 'Edit Company: ' . $company->name)
@section('content')
    <div class="page-header mb-3">
        <h2 class="mb-1 fw-bold text-dark">Edit Company: {{ $company->name }}</h2>
        <p class="text-muted mb-0">Update the company details below.</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('admin.companies.form', [
                'action' => route('admin.companies.update', $company->id),
                'edit' => true,
            ])
        </div>
    </div>
@endsection
