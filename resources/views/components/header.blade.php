@php
use Illuminate\Support\Facades\Auth;
@endphp

<header class="site-header navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span>Elixify</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                @auth
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.job-postings.index') }}">Job Postings</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.companies.index') }}">Companies</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.job-applications.index') }}">Applications</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('job-postings.index') }}">Browse Jobs</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('job-applications.index') }}">My Applications</a></li>
                    @endif
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('job-postings.index') }}">Browse Jobs</a></li>
                @endauth
                @auth
                    <li class="nav-item"><span class="nav-link">{{ Auth::user()->fullname }}</span></li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ route('auth.logout') }}" onclick="confirmLogout(event);">Logout</a></li>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('auth.login.page') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('auth.register.page') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</header>

<script>
    // Add scroll effect to header
    document.addEventListener('scroll', () => {
        const header = document.querySelector('.site-header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Confirm logout
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to logout?')) {
            document.getElementById('logout-form').submit();
        }
    }

    // Close navbar on link click
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navItems = document.querySelectorAll('.navbar-nav .nav-link');
    navItems.forEach(item => {
        item.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
                bsCollapse.hide();
            }
        });
    });
</script>
