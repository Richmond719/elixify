<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application - Elixify</title>
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

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .job-info {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border-left: 4px solid var(--secondary);
        }

        .job-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .job-company {
            color: var(--secondary);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.75rem;
            display: block;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 200px;
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.6;
        }

        .char-count {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        .form-error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-submit {
            background: var(--secondary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background: #3b82f6;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #e5e7eb;
            color: var(--primary);
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

        .btn-cancel:hover {
            background: #d1d5db;
            color: var(--primary);
        }

        .info-box {
            background: #dbeafe;
            border-left: 4px solid var(--secondary);
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
            color: #1e40af;
            font-size: 0.95rem;
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
            <a href="{{ route('job-applications.show', $jobApplication->id) }}" class="back-link">
                ← Back to Application
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-card">
                    <!-- Job Information -->
                    <div class="job-info">
                        <h3 class="job-title">{{ $jobApplication->jobPosting->title }}</h3>
                        <div class="job-company">{{ $jobApplication->jobPosting->company?->name ?? 'Company Name' }}</div>
                    </div>

                    <!-- Info Box -->
                    <div class="info-box">
                        ℹ️ You can only edit your application while it's in pending status. Once reviewed, you won't be able to make changes.
                    </div>

                    <!-- Edit Form -->
                    <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Cover Letter -->
                        <div class="form-group">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <textarea
                                class="form-control @error('cover_letter') is-invalid @enderror"
                                id="cover_letter"
                                name="cover_letter"
                                placeholder="Tell the employer why you're interested in this job and why you're a great fit..."
                            >{{ old('cover_letter', $jobApplication->cover_letter) }}</textarea>

                            <div class="char-count">
                                <span id="char-count">0</span> / 2000 characters
                            </div>

                            @error('cover_letter')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Save Changes</button>
                            <a href="{{ route('job-applications.show', $jobApplication->id) }}" class="btn-cancel">Cancel</a>
                        </div>
                    </form>
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
    <script>
        // Character counter for cover letter
        const coverLetterInput = document.getElementById('cover_letter');
        const charCount = document.getElementById('char-count');

        if (coverLetterInput) {
            coverLetterInput.addEventListener('input', function() {
                charCount.textContent = this.value.length;
            });

            // Set initial count
            charCount.textContent = coverLetterInput.value.length;
        }
    </script>
</body>
</html>
