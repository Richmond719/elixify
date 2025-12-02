<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details - Elixify</title>
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
            margin-bottom: 3rem;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .back-link:hover {
            color: var(--secondary);
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .job-header {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }

        .job-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .job-company {
            font-size: 1.1rem;
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .job-details {
            display: flex;
            gap: 3rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-weight: 500;
        }

        .status-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .status-label {
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
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

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .job-description {
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .cover-letter-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .cover-letter-text {
            color: #4b5563;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .application-meta {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .application-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary-custom {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            background: #3b82f6;
            transform: translateY(-2px);
            color: white;
        }

        .btn-danger-custom {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
        }

        .btn-danger-custom:hover {
            background: #dc2626;
            transform: translateY(-2px);
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
            <a href="{{ route('job-applications.index') }}" class="back-link">
                ← Back to My Applications
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Job Details -->
                <div class="detail-card">
                    <div class="job-header">
                        <h1 class="job-title">{{ $jobApplication->jobPosting->title }}</h1>
                        <div class="job-company">{{ $jobApplication->jobPosting->company?->name ?? 'Company Name' }}</div>

                        <div class="job-details">
                            <div class="detail-item">
                                <span>📍</span>
                                <span>{{ $jobApplication->jobPosting->location }}</span>
                            </div>
                            <div class="detail-item">
                                <span>Salary</span>
                                <span>{{ format_ghs($jobApplication->jobPosting->salary) }} / year</span>
                            </div>
                            <div class="detail-item">
                                <span>📂</span>
                                <span>{{ $jobApplication->jobPosting->classification }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Application Status -->
                    <div class="status-section">
                        <div class="status-label">Application Status</div>
                        <span class="status-badge status-{{ $jobApplication->status ?? 'pending' }}">
                            {{ ucfirst($jobApplication->status ?? 'Pending') }}
                        </span>
                    </div>

                    <!-- Application Details -->
                    <div class="application-meta">
                        <div>Applied on: <strong>{{ $jobApplication->applied_at?->format('F d, Y \a\t g:i A') ?? 'Recently' }}</strong></div>
                        <div>Applicant: <strong>{{ $jobApplication->applicant_name }}</strong></div>
                        <div>Email: <strong>{{ $jobApplication->applicant_email }}</strong></div>
                    </div>

                    <!-- Job Description -->
                    <h3 class="section-title">About This Job</h3>
                    <div class="job-description">
                        {{ $jobApplication->jobPosting->description }}
                    </div>

                    <!-- Cover Letter -->
                    @if($jobApplication->cover_letter)
                        <h3 class="section-title">Your Cover Letter</h3>
                        <div class="cover-letter-section">
                            <div class="cover-letter-text">{{ $jobApplication->cover_letter }}</div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="application-actions">
                        @if(Auth::user()->isJobSeeker())
                            @if($jobApplication->status === 'pending')
                                <a href="{{ route('job-applications.edit', $jobApplication->id) }}" class="btn-primary-custom">Edit Application</a>
                            @endif
                        @endif

                        <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to withdraw this application?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger-custom">Withdraw Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
