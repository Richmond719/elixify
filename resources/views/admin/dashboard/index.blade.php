@extends('admin.layout.master')
@section('title', 'Dashboard Overview')
@php
    $totalCompanies = \App\Models\Company::count();
    $totalJobPostings = \App\Models\JobPosting::count();
    $totalApplications = \App\Models\JobApplication::count();
    $newUsers = \App\Models\User::count();
@endphp
@section('content')
    <style>
        .metric-card { transition: transform 0.2s, box-shadow 0.2s; border-radius: 12px; }
        .metric-card:hover { transform: translateY(-4px); box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important; }
        .metric-card .metric-value { font-size: 2.2rem; }
        .metric-card .metric-label { font-size: 0.75rem; letter-spacing: 1px; }
        .metric-icon { font-size: 2.4rem; opacity: 0.15; }

        /* Modern Welcome Header */
        .welcome-header {
            background: #ffffff;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }
        .welcome-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #000000;
        }
        .welcome-header p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        .welcome-header .subtext {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .welcome-header .subtext-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
        .welcome-header .subtext-icon {
            font-size: 1rem;
            color: #6c757d;
            opacity: 0.6;
        }

        .chart-container { background-color: #fafbfc; border-radius: 12px; padding: 1.5rem; }
        .stat-badge { display: inline-block; background-color: #e9ecef; color: #495057; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .welcome-header { padding: 1.25rem 0; margin-bottom: 1.5rem; }
            .welcome-header h1 { font-size: 1.4rem; }
            .welcome-header p { font-size: 0.8rem; }
            .welcome-header .subtext { gap: 1rem; }
            .metric-card .metric-value { font-size: 1.75rem; }
            .metric-icon { font-size: 2rem; }
            .chart-container { padding: 1rem; }
            .card-header { padding: 1rem !important; }
            .card-header h6 { font-size: 0.9rem; }
        }

        @media (max-width: 576px) {
            .welcome-header { padding: 1rem 0; margin-bottom: 1rem; }
            .welcome-header h1 { font-size: 1.2rem; margin-bottom: 0.25rem; }
            .welcome-header p { font-size: 0.75rem; margin-bottom: 0.75rem; }
            .welcome-header .subtext { flex-direction: column; gap: 0.5rem; }
            .metric-card .metric-value { font-size: 1.5rem; }
            .metric-card .metric-label { font-size: 0.7rem; }
            .metric-icon { font-size: 1.75rem; }
            .card-body { padding: 1rem; }
            .d-flex { flex-wrap: wrap; }
            .progress { height: 5px !important; }
        }
    </style>

    <!-- Welcome Header - Practical, Real-World Style -->
    <div class="welcome-header">
        <h1>Dashboard</h1>
        <p>Welcome back, Admin. Here's your platform overview</p>
        <div class="subtext">
            <div class="subtext-item">
                <i class="bi bi-calendar3 subtext-icon"></i>
                <span>{{ date('l, F j, Y') }}</span>
            </div>
            <div class="subtext-item">
                <i class="bi bi-clock subtext-icon"></i>
                <span>Last synced: <span id="syncTime">just now</span></span>
            </div>
            <div class="subtext-item">
                <i class="bi bi-check-circle subtext-icon" style="opacity: 1; color: #22c55e;"></i>
                <span style="color: #22c55e;">All systems operational</span>
            </div>
        </div>
    </div>

    <!-- KPI Metrics Section -->
    <div class="row mb-4">
        <!-- Total Companies Card -->
        <a href="{{ url('/admin/companies') }}" class="col-12 col-sm-6 col-lg-3 mb-4" style="text-decoration: none;">
            <div class="card metric-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div class="grow">
                        <p class="metric-label text-muted text-uppercase mb-2">Total Companies</p>
                        <p class="metric-value mb-0 fw-bold text-dark">{{ $totalCompanies }}</p>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> Active Companies</small>
                    </div>
                    <i class="bi bi-building metric-icon text-dark ms-2"></i>
                </div>
            </div>
        </a>

        <!-- Active Job Postings Card -->
        <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card metric-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div class="grow">
                        <p class="metric-label text-muted text-uppercase mb-2">Active Job Postings</p>
                        <p class="metric-value mb-0 fw-bold text-dark">{{ $totalJobPostings }}</p>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> Available Positions</small>
                    </div>
                    <i class="bi bi-briefcase metric-icon text-dark ms-2"></i>
                </div>
            </div>
        </div>

        <!-- Job Applications Card -->
        <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card metric-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div class="grow">
                        <p class="metric-label text-muted text-uppercase mb-2">Total Applications</p>
                        <p class="metric-value mb-0 fw-bold text-dark">{{ $totalApplications }}</p>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> Pending Review</small>
                    </div>
                    <i class="bi bi-file-earmark-check metric-icon text-dark ms-2"></i>
                </div>
            </div>
        </div>

        <!-- New Users Card -->
        <div class="col-12 col-sm-6 col-lg-3 mb-4">
            <div class="card metric-card border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div class="grow">
                        <p class="metric-label text-muted text-uppercase mb-2">Total Users</p>
                        <p class="metric-value mb-0 fw-bold text-dark">{{ $newUsers }}</p>
                        <small class="text-success"><i class="bi bi-arrow-up"></i> Registered Users</small>
                    </div>
                    <i class="bi bi-people metric-icon text-dark ms-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics Section -->
    <div class="row">
        <!-- Application Trends Chart -->
        <div class="col-12 col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-3" style="border-bottom: 1px solid #e9ecef; background-color: #ffffff;">
                    <h6 class="m-0 fw-bold text-dark">Application Trends</h6>
                    <span class="badge bg-light text-dark mt-2 mt-sm-0">Last 6 Months</span>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="applicationTrendChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="col-12 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header py-3" style="border-bottom: 1px solid #e9ecef; background-color: #ffffff;">
                    <h6 class="m-0 fw-bold text-dark">Quick Summary</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2 flex-wrap">
                            <span class="text-muted small">Conversion Rate</span>
                            <span class="fw-bold">{{ $conversionRate }}%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px;">
                            <div class="progress-bar bg-dark" style="width: {{ $conversionRate }}%;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2 flex-wrap">
                            <span class="text-muted small">Platform Activity</span>
                            <span class="fw-bold">{{ $platformActivity }}%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px;">
                            <div class="progress-bar bg-secondary" style="width: {{ $platformActivity }}%;"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2 flex-wrap">
                            <span class="text-muted small">User Satisfaction</span>
                            <span class="fw-bold">{{ $userSatisfaction }}%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 3px;">
                            <div class="progress-bar bg-light" style="width: {{ $userSatisfaction }}%; background-color: #adb5bd !important;"></div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="small text-muted">
                        <p class="mb-1"><strong>Platform Status:</strong> <span class="badge bg-success">Operational</span></p>
                        <p class="mb-0"><strong>Last Update:</strong> <span class="text-dark" id="lastUpdate">now</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Real-time last update display
    function updateTimeAgo() {
        const lastUpdateEl = document.getElementById('lastUpdate');
        const syncTimeEl = document.getElementById('syncTime');

        if (!lastUpdateEl && !syncTimeEl) return;

        const createdAt = new Date('{{ $lastUpdate->toIso8601String() }}');
        const now = new Date();
        const secondsAgo = Math.floor((now - createdAt) / 1000);

        let timeText = 'now';
        if (secondsAgo < 60) {
            timeText = 'just now';
        } else if (secondsAgo < 3600) {
            const minutes = Math.floor(secondsAgo / 60);
            timeText = `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
        } else if (secondsAgo < 86400) {
            const hours = Math.floor(secondsAgo / 3600);
            timeText = `${hours} hour${hours > 1 ? 's' : ''} ago`;
        } else {
            timeText = createdAt.toLocaleDateString();
        }

        if (lastUpdateEl) lastUpdateEl.textContent = timeText;
        if (syncTimeEl) syncTimeEl.textContent = timeText;
    }

    // Update on page load and every 10 seconds
    updateTimeAgo();
    setInterval(updateTimeAgo, 10000);
</script>
@endpush




