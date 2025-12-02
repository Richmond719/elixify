<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Job Applications - Elixify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1f2937;
            --secondary: #60a5fa;
            --accent: #f59e0b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f3f4f6;
        }

        .navbar {
            background: var(--primary);
            padding: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.8) !important;
            margin-left: 2rem;
            transition: all 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--secondary) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--secondary) !important;
            font-weight: 600;
        }

        .logo-text {
            color: var(--secondary);
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #374151 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .alert {
            margin-bottom: 2rem;
        }

        .application-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border-left: 4px solid var(--secondary);
        }

        .application-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .job-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .job-company {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .application-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            font-size: 0.95rem;
            color: #6b7280;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-reviewing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-accepted {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .application-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-view {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-view:hover {
            background: #3b82f6;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .no-applications {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            color: #6b7280;
        }

        .pagination {
            justify-content: center;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .pagination .page-link {
            color: var(--secondary);
            border-color: var(--secondary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .footer {
            background: var(--primary);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                Eli<span class="logo-text">x</span>ify
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('job-postings.index') }}">Browse Jobs</a>
                    </li>
                    @auth
                        @if(Auth::user()->isJobSeeker())
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('job-applications.index') }}">My Applications</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link" style="border:none;background:none;cursor:pointer;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.login.page') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>My Job Applications</h1>
            <p>Track your job applications and their status</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($applications->count() > 0)
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    @foreach($applications as $application)
                        <div class="application-card">
                            <h3 class="job-title">{{ $application->jobPosting->title }}</h3>
                            <div class="job-company">{{ $application->jobPosting->company?->name ?? 'Company Name' }}</div>

                            <div class="application-meta">
                                <div>
                                    <span>📅 Applied:</span>
                                    <span>{{ $application->applied_at?->format('M d, Y') ?? 'Recently' }}</span>
                                </div>
                                <div>
                                    <span>📍 Location:</span>
                                    <span>{{ $application->jobPosting->location }}</span>
                                </div>
                                <div>
                                    <span class="status-badge status-{{ $application->status ?? 'pending' }}">
                                        {{ ucfirst($application->status ?? 'Pending') }}
                                    </span>
                                </div>
                            </div>

                            @if($application->cover_letter)
                                <p style="color: #4b5563; margin-bottom: 1rem; font-size: 0.95rem;">
                                    <strong>Cover Letter:</strong> {{ Str::limit($application->cover_letter, 100) }}
                                </p>
                            @endif

                            <div class="application-actions">
                                <a href="{{ route('job-applications.show', $application->id) }}" class="btn-view">View Details</a>
                                <form action="{{ route('job-applications.destroy', $application->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to withdraw this application?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Withdraw</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    {{ $applications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="no-applications">
                        <h3>No Applications Yet</h3>
                        <p>You haven't applied for any jobs yet. Start browsing and apply for your dream job!</p>
                        <a href="{{ route('job-postings.index') }}" class="btn btn-primary mt-3">Browse Jobs</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <p>&copy; 2025 Elixify. Ghana's Job Marketplace. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
