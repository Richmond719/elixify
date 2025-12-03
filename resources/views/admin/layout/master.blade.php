<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elixify Admin | @yield('title', 'Dashboard')</title>
    <!-- Fonts: Inter (modern UI) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.style.css') }}">
    <!-- Chart.js for Application Trends -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
    <div class="d-flex flex-column flex-md-row sidebar-hidden" id="wrapper">
        @include('admin.layout.sidebar')
        <!-- Page Content Wrapper -->
        <div id="page-content-wrapper" class="flex-grow-1 w-100 min-vh-100" style="max-width: 100vw;">
            @include('admin.layout.topnav')
            <!-- Page Content -->
            <div class="container-fluid py-4">
                @yield('content')
            </div>
            <!-- End Page Content -->
            @include('admin.layout.footer')
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/toggle-sidebar.js') }}"></script>
    <script>
        // Chart.js implementation - run only when the canvas exists
        (function () {
            const canvas = document.getElementById('applicationTrendChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
                    datasets: [{
                        label: 'Applications',
                        data: {!! json_encode($chartData ?? [0, 0, 0, 0, 0, 0]) !!},
                        backgroundColor: 'rgba(0,0,0,0.08)',
                        borderColor: 'rgba(0,0,0,0.9)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointBackgroundColor: '#000000',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: Math.ceil(Math.max(...{!! json_encode($chartData ?? [1]) !!}) / 5) || 1 }
                        }
                    },
                    plugins: {
                        legend: { display: true, labels: { font: { size: 12 } } },
                        filler: { propagate: true }
                    }
                }
            });
        })();
    </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* SweetAlert2 Black and White Theme for Admin */
            .swal2-popup {
                background-color: #fff !important;
                border: 2px solid #111 !important;
                border-radius: 12px !important;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3) !important;
            }
            .swal2-title {
                color: #111 !important;
                font-weight: 700 !important;
            }
            .swal2-html-container {
                color: #333 !important;
            }
            .swal2-confirm {
                background-color: #111 !important;
                border-color: #111 !important;
                color: #fff !important;
                font-weight: 600 !important;
            }
            .swal2-confirm:hover {
                background-color: #333 !important;
                border-color: #333 !important;
            }
            .swal2-cancel {
                background-color: #f0f0f0 !important;
                border-color: #ddd !important;
                color: #111 !important;
                font-weight: 600 !important;
            }
            .swal2-cancel:hover {
                background-color: #e0e0e0 !important;
                border-color: #bbb !important;
            }
            .swal2-icon {
                border-color: #111 !important;
            }
            .swal2-icon.swal2-success .swal2-success-ring {
                border-color: #111 !important;
            }
            .swal2-icon.swal2-success [class*=swal2-success-line] {
                background-color: #111 !important;
            }
            .swal2-icon.swal2-error [class*=swal2-x-mark] line {
                stroke: #111 !important;
            }
            .swal2-icon.swal2-warning {
                border-color: #111 !important;
                color: #111 !important;
            }
            .swal2-icon.swal2-info {
                border-color: #111 !important;
                color: #111 !important;
            }
            .swal2-icon.swal2-question {
                border-color: #111 !important;
                color: #111 !important;
            }
        </style>
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
