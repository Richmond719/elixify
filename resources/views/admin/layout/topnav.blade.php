
@php
use Illuminate\Support\Facades\Auth;
@endphp

<header class="site-header navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
        <!-- Sidebar Toggle Button (for mobile) -->
        <button id="sidebarToggleBtn" class="btn btn-outline-light me-3 d-lg-none" type="button" aria-label="Toggle sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <span>Elixify</span>
        </a>

        <!-- User Section with Home Button -->
        @auth
        <div class="d-flex align-items-center gap-3">
            <a class="btn btn-link nav-link text-white" href="{{ url('/') }}">
                <i class="bi bi-house-door me-1"></i>Home
            </a>
            <div class="dropdown">
                <button class="btn btn-link nav-link dropdown-toggle text-white d-flex align-items-center"
                        type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-2"></i>
                    {{ Auth::user()->fullname }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('auth.logout') }}" onclick="confirmLogout(event);">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a></li>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
        @else
        <div class="d-flex gap-2">
            <a class="btn btn-outline-light btn-sm" href="{{ route('auth.login.page') }}">Login</a>
            <a class="btn btn-light btn-sm" href="{{ route('auth.register.page') }}">Register</a>
        </div>
        @endauth
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
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
