<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Elixify')</title>
    <!-- Preconnect to external CDNs for faster loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://videos.pexels.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Admin specific CSS (sidebar, admin layout) -->
    <link rel="stylesheet" href="{{ asset('css/admin.style.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Header Navigation -->
    @include('admin.layout.topnav')

    <div class="d-flex flex-column flex-md-row sidebar-hidden" id="wrapper">
        @include('admin.layout.sidebar')
        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper" class="grow w-100 min-vh-100" style="max-width: 100vw;">
            <!-- Page Content -->
            <div class="container-fluid py-4">
                @yield('content')
            </div>
            <!-- End Page Content -->
        </div>
    </div>

    @include('admin.layout.footer')
    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Sidebar Toggle JS -->
    <script src="{{ asset('js/toggle-sidebar.js') }}"></script>

    @stack('scripts')
        <script>
            @session('status')
                const isError = Boolean({{ isset($value['error']) && $value['error'] == true }})
                Swal.fire({
                    title: isError ? 'Error!' : 'Success',
                    text: "{{ $value['message'] ?? 'Done' }}",
                    icon: isError ? 'error' : 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#111',
                    background: '#fff',
                    color: '#111'
                })
            @endsession
        </script>
        <script>
            // Live footer "Last sync" updater — updates every 60s using the server-provided ISO timestamp
            (function () {
                const el = document.getElementById('footer-sync');
                if (!el) return;
                function relativeTime(iso) {
                    const then = new Date(iso);
                    const now = new Date();
                    const diff = Math.floor((now - then) / 1000); // seconds
                    if (diff < 10) return 'just now';
                    if (diff < 60) return diff + ' seconds ago';
                    const mins = Math.floor(diff / 60);
                    if (mins < 60) return mins + (mins === 1 ? ' minute ago' : ' minutes ago');
                    const hours = Math.floor(mins / 60);
                    if (hours < 24) return hours + (hours === 1 ? ' hour ago' : ' hours ago');
                    const days = Math.floor(hours / 24);
                    if (days < 7) return days + (days === 1 ? ' day ago' : ' days ago');
                    return then.toLocaleDateString();
                }
                function update() {
                    const ts = el.getAttribute('data-timestamp');
                    if (!ts) return;
                    const span = el.querySelector('.fw-medium');
                    if (span) span.textContent = relativeTime(ts);
                    else el.textContent = 'Last sync: ' + relativeTime(ts);
                }
                update();
                setInterval(update, 60 * 1000);
            })();
        </script>
    <script>
        function logout() {
            Swal.fire({
                title: "Are you sure you want to logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#111",
                cancelButtonColor: "#f0f0f0",
                confirmButtonText: "Yes, log out!",
                background: '#fff',
                color: '#111'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('logoutForm');
                    form.submit();
                }
            });
        }
    </script>
        @stack('scripts')
</body>
</html>
