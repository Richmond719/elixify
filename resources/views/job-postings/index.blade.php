<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs - Elixify</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { background: #f5f5f5; color: var(--fg); font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }

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

        /* Main layout */
        .jobs-main {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .search-sidebar {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            height: fit-content;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 80px;
        }

        .search-sidebar h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--fg);
        }

        .search-sidebar .form-group {
            margin-bottom: 1.5rem;
        }

        .search-sidebar label {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--fg);
            margin-bottom: 0.5rem;
            display: block;
        }

        .search-sidebar input,
        .search-sidebar select {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 0.9rem;
            color: var(--fg);
            background: white;
            transition: border-color 0.3s;
        }

        .search-sidebar input:focus,
        .search-sidebar select:focus {
            outline: none;
            border-color: var(--fg);
            box-shadow: 0 0 0 2px rgba(0,0,0,0.05);
        }

        .search-btn {
            width: 100%;
            background: var(--fg);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .search-btn:hover {
            opacity: 0.9;
        }

        .jobs-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .job-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.18s ease;
            cursor: default;
            position: relative;
        }

        .job-card:hover {
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }

        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }

        .job-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--fg);
            margin: 0;
            transition: color 0.3s;
        }

        .job-posted {
            font-size: 0.8rem;
            color: var(--muted);
            white-space: nowrap;
            text-align: right;
        }

        .job-card:hover .job-title {
            color: #0a66c2;
        }

        .job-company {
            font-size: 0.95rem;
            color: var(--muted);
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .job-posted {
            font-size: 0.8rem;
            color: var(--muted);
            white-space: nowrap;
        }

        .job-meta {
            display: flex;
            gap: 1rem;
            margin: 0.75rem 0;
            flex-wrap: wrap;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .job-meta-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .job-description {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #555;
            margin: 1rem 0;
        }

        .job-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 0.5rem 0 0.75rem 0;
        }

        .tag {
            background: transparent;
            border: 1px solid #e9ecef;
            color: var(--muted);
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .job-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            justify-content: space-between;
            align-items: center;
        }

        .btn-apply {
            background: var(--fg);
            color: white;
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-apply:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-details {
            background: transparent;
            color: var(--fg);
            border: 1px solid #dee2e6;
            padding: 0.6rem 1.25rem;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-details:hover {
            border-color: var(--fg);
            background: #f5f5f5;
        }

        .no-jobs {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1rem;
            background: white;
            border-radius: 8px;
            color: var(--muted);
        }

        .no-jobs h3 {
            color: var(--fg);
            margin-bottom: 0.5rem;
        }

        .pagination {
            justify-content: center;
            margin-top: 2rem;
            grid-column: 1 / -1;
        }

        .pagination .page-link {
            color: var(--fg);
            border-color: #dee2e6;
            background-color: white;
            border-radius: 4px;
        }

        .pagination .page-link:hover {
            background-color: #f5f5f5;
            border-color: var(--fg);
            color: var(--fg);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--fg);
            border-color: var(--fg);
        }

        .site-footer {
            background: var(--primary-bg);
            color: var(--primary-text);
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
            font-size: 0.9rem;
        }

        .search-results-info {
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: var(--muted);
        }

        @media (max-width: 768px) {
            .jobs-main {
                grid-template-columns: 1fr;
            }

            .search-sidebar {
                position: static;
            }

            .job-header {
                flex-direction: column;
            }

            .job-posted {
                order: -1;
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <header class="site-header navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="font-size: 1.5rem;">Elixify</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('job-postings.index') }}">Browse Jobs</a></li>
                    @auth
                        @if(Auth::user()->isJobSeeker())
                            <li class="nav-item"><a class="nav-link" href="{{ route('job-applications.index') }}">My Applications</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.login.page') }}">Login</a></li>
                    @endauth
                    @auth
                        <li class="nav-item"><span class="nav-link">{{ Auth::user()->fullname }}</span></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="jobs-main">
        <!-- Left Sidebar - Search Filters -->
        <aside class="search-sidebar">
            <h3>Find Jobs</h3>
            <form method="GET" action="{{ route('job-postings.index') }}">
                <div class="form-group">
                    <label>Job Title or Keyword</label>
                    <input
                        type="text"
                        name="search"
                        placeholder="e.g., Developer, Designer"
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <select name="location">
                        <option value="">All Locations</option>
                        <option value="Accra" {{ request('location') === 'Accra' ? 'selected' : '' }}>Accra</option>
                        <option value="Kumasi" {{ request('location') === 'Kumasi' ? 'selected' : '' }}>Kumasi</option>
                        <option value="Tema" {{ request('location') === 'Tema' ? 'selected' : '' }}>Tema</option>
                        <option value="Takoradi" {{ request('location') === 'Takoradi' ? 'selected' : '' }}>Takoradi</option>
                        <option value="Tamale" {{ request('location') === 'Tamale' ? 'selected' : '' }}>Tamale</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Job Type</label>
                    <select name="type">
                        <option value="">All Types</option>
                        <option value="Full-time" {{ request('type') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ request('type') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ request('type') === 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ request('type') === 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>

                <button type="submit" class="search-btn">Search Jobs</button>
                @if(request('search') || request('location') || request('type'))
                    <a href="{{ route('job-postings.index') }}" style="display: block; text-align: center; margin-top: 0.75rem; color: var(--muted); text-decoration: none; font-size: 0.9rem; font-weight: 500;">Clear Filters</a>
                @endif
            </form>
        </aside>

        <!-- Right Content - Job List -->
        <div>
            @if(request('search') || request('location') || request('type'))
                <div class="search-results-info">
                    Showing results for
                    @if(request('search')): <strong>{{ request('search') }}</strong>@endif
                    @if(request('location')): <strong>{{ request('location') }}</strong>@endif
                    @if(request('type')): <strong>{{ request('type') }}</strong>@endif
                    <a href="{{ route('job-postings.index') }}" style="margin-left: 0.5rem;">Clear all</a>
                </div>
            @endif

            <div class="jobs-list">
                @if($jobPostings->count() > 0)
                    @foreach($jobPostings as $job)
                        <div class="job-card">
                            <div class="job-header">
                                <div style="flex: 1;">
                                    <h3 class="job-title">{{ $job->title }}</h3>
                                    <div class="job-company">{{ $job->company?->name ?? 'Company' }}</div>
                                </div>
                                <div class="job-posted">{{ $job->created_at?->diffForHumans() ?? 'Recently posted' }}</div>
                            </div>

                            <div class="job-meta">
                                <div class="job-meta-item">{{ $job->location }}</div>
                                <div class="job-meta-item">{{ format_ghs($job->salary) }}</div>
                                <div class="job-meta-item">{{ $job->classification }}</div>
                            </div>

                            <div class="job-tags">
                                @if($job->created_at?->diffInDays(now()) < 7)
                                    <span class="tag">New</span>
                                @endif
                            </div>

                            <div class="job-description">
                                {{ Str::limit($job->description, 250) }}
                            </div>

                            <div class="job-actions">
                                <div style="display: flex; gap: 0.75rem;">
                                    @auth
                                        @if(Auth::user()->isJobSeeker())
                                            <form action="{{ route('job-applications.store') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="job_posting_id" value="{{ $job->id }}">
                                                <button type="submit" class="btn-apply">Apply Now</button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('auth.login.page') }}" class="btn-apply">Apply Now</a>
                                    @endauth

                                    <a href="{{ route('job-postings.show', $job->id) }}" class="btn-details">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <nav aria-label="Page navigation" style="grid-column: 1 / -1;">
                        {{ $jobPostings->links('pagination::bootstrap-5') }}
                    </nav>
                @else
                    <div class="no-jobs">
                        <h3>No jobs available</h3>
                        <p>Check back soon for new opportunities</p>
                    </div>
                @endif
                </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="position: relative; overflow: hidden; background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%); color: #fff; margin-top: 0;">
        <!-- Video Background -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; opacity: 0.15;">
                <source src="https://videos.pexels.com/video-files/3250236/3250236-hd_1920_1080_25fps.mp4" type="video/mp4">
            </video>
        </div>

        <!-- Animated Gradient Overlay -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at 20% 50%, rgba(0, 0, 0, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 80%, rgba(0, 0, 0, 0.1) 0%, transparent 50%); z-index: 1;"></div>

        <!-- Footer Content -->
        <div style="position: relative; z-index: 2; padding: 1.5rem 2rem 1rem; max-width: 1400px; margin: 0 auto;">
            <!-- Brand Section - Centered -->
            <div class="brand-section" style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -0.5px;">Elixify</h3>
                <p style="color: rgba(255,255,255,0.8); line-height: 1.4; margin-bottom: 0.8rem; max-width: 600px; margin-left: auto; margin-right: auto; font-size: 0.85rem;">Connecting extraordinary talent with transformative opportunities. Build your career with us.</p>
                <div class="social-icons" style="display: flex; gap: 0.8rem; font-size: 1.2rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#" style="color: #fff; background: rgba(255,255,255,0.15); width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fff'; this.style.color='#1a1a2e'; this.style.transform='scale(1.15) rotate(360deg)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'; this.style.transform='scale(1)';">
                        <i class="bi bi-facebook" style="display: inline-block;"></i>
                    </a>
                    <a href="#" style="color: #fff; background: rgba(255,255,255,0.15); width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fff'; this.style.color='#1a1a2e'; this.style.transform='scale(1.15) rotate(360deg)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'; this.style.transform='scale(1)';">
                        <i class="bi bi-twitter-x" style="display: inline-block;"></i>
                    </a>
                    <a href="#" style="color: #fff; background: rgba(255,255,255,0.15); width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fff'; this.style.color='#1a1a2e'; this.style.transform='scale(1.15) rotate(360deg)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'; this.style.transform='scale(1)';">
                        <i class="bi bi-github" style="display: inline-block;"></i>
                    </a>
                    <a href="#" style="color: #fff; background: rgba(255,255,255,0.15); width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#fff'; this.style.color='#1a1a2e'; this.style.transform='scale(1.15) rotate(360deg)';" onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.color='#fff'; this.style.transform='scale(1)';">
                        <i class="bi bi-instagram" style="display: inline-block;"></i>
                    </a>
                </div>
            </div>

            <!-- Navigation Grid - Centered -->
            <div class="navigation-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 2rem; max-width: 900px; margin-left: auto; margin-right: auto;">
                <!-- For Job Seekers -->
                <div class="nav-column" style="text-align: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: 0.95rem; color: #60a5fa; text-transform: uppercase; letter-spacing: 0.5px;">Job Seekers</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.9rem;">
                        <li><a href="{{ route('job-postings.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Browse Jobs</a></li>
                        <li><a href="{{ Auth::check() ? route('job-applications.index') : route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">My Applications</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Career Tips</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Profile Builder</a></li>
                    </ul>
                </div>

                <!-- For Companies -->
                <div class="nav-column" style="text-align: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: 0.95rem; color: #60a5fa; text-transform: uppercase; letter-spacing: 0.5px;">Companies</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.9rem;">
                        <li><a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.job-postings.create') : route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Post Job</a></li>
                        <li><a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.dashboard') : route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Dashboard</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Pricing</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Resources</a></li>
                    </ul>
                </div>

                <!-- Legal & Support -->
                <div class="nav-column" style="text-align: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: 0.95rem; color: #60a5fa; text-transform: uppercase; letter-spacing: 0.5px;">Support</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.9rem;">
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Privacy Policy</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Terms of Service</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Contact Us</a></li>
                        <li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider" style="border-top: 1px solid rgba(255,255,255,0.2); margin: 3rem 0;"></div>

            <!-- Bottom Section -->
            <div class="bottom-section" style="display: flex; flex-direction: column; gap: 1.5rem; text-align: center;">
                <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 1rem; font-size: 0.9rem;">
                    <span style="color: rgba(255,255,255,0.7);">Made with <span style="color: #ef4444;">❤</span> by the Elixify Team</span>
                </div>
                <p style="color: rgba(255,255,255,0.6); margin: 0; font-size: 0.85rem;">&copy; {{ date('Y') }} Elixify. Connecting talent with opportunity. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show alert when jobs are successfully filtered
        @if(request('search') || request('location') || request('type'))
            Swal.fire({
                title: 'Search Results',
                text: 'Showing jobs matching your criteria',
                icon: 'success',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        // Add confirmation to apply for job
        document.addEventListener('DOMContentLoaded', function() {
            const applyButtons = document.querySelectorAll('.btn-apply');
            applyButtons.forEach(button => {
                if (button.type === 'submit') {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Apply for this job?',
                            text: 'Are you sure you want to submit your application?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, apply!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.closest('form').submit();
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
