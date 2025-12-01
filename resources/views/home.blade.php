<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elixify — Find Your Next Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-white text-black">
    <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" height="40" alt="Logo" onerror="this.onerror=null;this.src='{{ asset('img/logo.svg') }}';">
                <span class="ms-2 fw-bold">Elixify</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Post A Job</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Find Jobs</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="container py-5">
        <section class="hero text-center py-5 mb-4">
            <h1 class="mb-2" style="font-size: 1.9rem; font-weight: 700;">Find your next opportunity</h1>
            <p class="text-muted mb-3">Search curated jobs from top employers — fast and free.</p>
            <form method="get" action="{{ url('/') }}" class="row g-2 justify-content-center">
                <div class="col-12 col-md-7">
                    <input name="q" value="{{ request('q') }}" type="search" class="form-control form-control-lg" placeholder="Search jobs by title, skills, location...">
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark btn-lg" type="submit"><i class="bi bi-search me-2"></i>Search</button>
                </div>
            </form>
        </section>

        <section class="featured-jobs mb-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h4 mb-0">Featured Jobs</h2>
                @if(isset($jobpostings) && $jobpostings->total())
                    <small class="text-muted">Showing {{ $jobpostings->count() }} of {{ $jobpostings->total() }}</small>
                @endif
            </div>

            @if(isset($jobpostings) && $jobpostings->count())
                <div class="row g-4">
                    @foreach($jobpostings as $job)
                        <div class="col-12 col-md-6 col-lg-4">
                            <article class="card job-card h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5 class="mb-0">{{ $job->title }}</h5>
                                        <span class="badge job-type-badge">{{ $job->employment_type ?? 'Job' }}</span>
                                    </div>
                                    <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($job->description ?? 'No description provided', 120) }}</p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div class="small text-muted"><i class="bi bi-geo-alt-fill me-1"></i>{{ $job->location ?? 'Remote' }}</div>
                                        <div>
                                            @if($job->salary_from)
                                                <strong>${{ number_format($job->salary_from) }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">{{ $jobpostings->links('pagination::bootstrap-5') }}</div>
            @else
                <div class="p-5 border rounded-3 text-center">
                    <p class="mb-0 text-muted">We couldn't find any job postings yet. Try adjusting your search or check back later.</p>
                </div>
            @endif
        </section>
    </main>

    <footer class="bg-black text-white text-center py-4">
        <div class="container small">&copy; {{ date('Y') }} Elixify — Connecting talent with opportunity</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
