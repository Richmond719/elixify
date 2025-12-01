@extends('admin.layout.master')
@section('title', 'My Profile')
@section('content')

<div class="page-header mb-4 d-flex justify-content-between align-items-start">
    <div>
        <h2 class="mb-1 fw-bold">My Profile</h2>
        <p class="text-muted mb-0">Manage your account information and preferences.</p>
    </div>
    <div>
        <a href="{{ route('admin.settings.index') ?? '#' }}" class="btn btn-outline-secondary btn-sm">Edit Settings</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center p-4">
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:96px;height:96px;font-size:1.4rem;">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                <h5 class="fw-bold mb-1">{{ $user->name ?? 'Admin' }}</h5>
                <div class="small text-muted mb-3">{{ $user->email ?? 'no-email@example.com' }}</div>
                <a href="{{ route('admin.settings.index') ?? '#' }}" class="btn btn-dark btn-sm">Edit Profile</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3">Account Details</h6>
                <dl class="row">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">{{ $user->name ?? '—' }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $user->email ?? '—' }}</dd>

                    <dt class="col-sm-4">Member Since</dt>
                    <dd class="col-sm-8">{{ $user->created_at?->format('M d, Y') ?? '—' }}</dd>
                </dl>
                <hr>
                <h6 class="fw-bold mb-3">Preferences</h6>
                <p class="text-muted small">You can manage additional account preferences in Settings.</p>
            </div>
        </div>
    </div>
</div>

@endsection
