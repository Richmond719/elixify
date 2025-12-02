<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jobPosting->title }} - Elixify</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { background: var(--bg); color: var(--fg); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }

        .site-header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .site-header .navbar-brand {
            color: #fff !important;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            transition: transform 0.3s ease;
        }

        .site-header .navbar-brand:hover {
            transform: scale(1.05);
        }

        .site-header .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .site-header .nav-link:hover,
        .site-header .nav-link.active {
            color: #fff !important;
        }

        .site-header .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #fff;
            transition: width 0.3s ease;
        }

        .site-header .nav-link:hover::after,
        .site-header .nav-link.active::after {
            width: 100%;
        }

        .job-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1rem;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: var(--fg);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .back-link:hover {
            color: var(--muted);
        }

        .job-header {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
        }

        .job-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .job-company {
            font-size: 1rem;
            color: var(--muted);
            margin-bottom: 1rem;
        }

        .job-meta {
            display: flex;
            gap: 2rem;
            margin: 1.5rem 0;
            flex-wrap: wrap;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .job-description {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--fg);
            margin-bottom: 2rem;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .apply-section {
            background: var(--bg);
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 2rem;
            margin-top: 2rem;
        }

        .apply-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            font-family: inherit;
            font-size: 0.95rem;
            resize: vertical;
            min-height: 120px;
            transition: all 0.3s;
        }

        textarea:focus {
            outline: none;
            border-color: var(--fg);
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05);
        }

        .btn-primary-custom {
            background: var(--fg);
            color: var(--primary-text);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-primary-custom:hover {
            opacity: 0.9;
            color: var(--primary-text);
        }

        .alert {
            margin-bottom: 2rem;
        }

        .site-footer {
            background: var(--primary-bg);
            color: var(--primary-text);
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid" style="max-width: 900px;">
                <a class="navbar-brand" href="/">Elixify</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('job-postings.index') }}">Browse Jobs</a>
                        </li>
                        @auth
                            @if(Auth::user()->isJobSeeker())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('job-applications.index') }}">My Applications</a>
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
    </header>

    <!-- Main Content -->
    <div class="job-container">
        <a href="{{ route('job-postings.index') }}" class="back-link">← Back to jobs</a>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="job-header">
            <h1 class="job-title">{{ $jobPosting->title }}</h1>
            <div class="job-company">{{ $jobPosting->company?->name ?? 'Company' }}</div>

            <div class="job-meta">
                <div>📍 {{ $jobPosting->location }}</div>
                <div>💰 {{ format_ghs($jobPosting->salary) }}</div>
                <div>{{ $jobPosting->classification }}</div>
            </div>
        </div>

        <div class="job-description">
            {{ $jobPosting->description }}
        </div>

        @auth
            @if(Auth::user()->isJobSeeker())
                <div class="apply-section">
                    <h3>Apply for this position</h3>
                    <form action="{{ route('job-applications.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="job_posting_id" value="{{ $jobPosting->id }}">

                        <div class="form-group">
                            <label for="cover_letter" class="form-label">Cover Letter (optional)</label>
                            <textarea
                                id="cover_letter"
                                name="cover_letter"
                                placeholder="Tell us why you're interested in this role and what makes you a great fit..."
                                class="@error('cover_letter') is-invalid @enderror"
                            ></textarea>
                            @error('cover_letter')
                                <small style="color: #dc2626; display: block; margin-top: 0.5rem;">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary-custom">Submit Application</button>
                    </form>
                </div>
            @endif
        @else
            <div class="apply-section">
                <h3>Ready to apply?</h3>
                <p style="margin-bottom: 1rem;">Log in to submit your application.</p>
                <a href="{{ route('auth.login.page') }}" class="btn-primary-custom">Login to Apply</a>
            </div>
        @endauth
    </div>

    <!-- Footer -->
    <footer class="site-footer">
        <div style="max-width: 900px; margin: 0 auto;">
            <p>&copy; 2025 Elixify. Ghana's Job Marketplace.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
