@php
use Illuminate\Support\Facades\Auth;
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elixify — Find Your Next Role</title>
    <!-- Preconnect to external CDNs for faster loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="preconnect" href="https://videos.pexels.com">
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" as="style">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* SweetAlert2 Black and White Theme */
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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { background: #fff; color: var(--fg); overflow-x: hidden; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }

        /* Smooth scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }

        /* Header - Sticky & Interactive */
        .site-header {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .site-header.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
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
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.3) !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(135deg, #fff 0%, #fafafa 100%);
        }

            .hero-parallax-bg {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                transform: translateZ(0);
                will-change: transform;
            }

            .hero-parallax-bg video {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transform: translate(-50%, -50%);
                opacity: 0.38;
                pointer-events: none;
            }

            .hero-parallax-bg::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, rgba(255,255,255,0.38) 0%, rgba(250,250,250,0.26) 100%);
                pointer-events: none;
            }
        .hero-parallax-bg video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }

        .hero-parallax-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.35) 0%, rgba(250, 250, 250, 0.25) 100%);
            pointer-events: none;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(3deg); }
        }

        /* Shine Effect Animation */
        @keyframes shine {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        /* Glow Pulse Animation */
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
        }

        /* Slide In Animation */
        @keyframes slide-in-right {
            from { transform: translateX(100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slide-in-left {
            from { transform: translateX(-100px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Rotate Animation */
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* 3D Perspective for depth */
        section {
            perspective: 1000px;
        }

        /* Gallery Section 3D Enhancement */
        .gallery-section {
            background: #fff;
            position: relative;
        }

        .gallery-item {
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .gallery-item:hover {
            transform: translateY(-12px) perspective(1000px) rotateX(5deg) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.6s;
        }

        .gallery-item:hover::before {
            opacity: 1;
            animation: shine 0.6s;
        }

        /* Featured Jobs 3D Enhancement */
        .featured-jobs-section {
            background: #fff;
            position: relative;
        }

        .job-card {
            transform-style: preserve-3d;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            opacity: 0;
            transition: opacity 0.5s;
        }

        .job-card:hover {
            transform: translateZ(20px) perspective(1000px) rotateX(8deg) rotateY(-5deg) scale(1.02);
            box-shadow: 0 30px 80px rgba(0,0,0,0.15) !important;
        }

        .job-card:hover::before {
            opacity: 1;
            animation: shine 0.5s;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 950px;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: 5rem;
            font-weight: 900;
            line-height: 1.2;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            letter-spacing: -1.5px;
            animation: slideInDown 0.8s ease-out;
        }

        .hero-content .subtitle {
            font-size: 1.35rem;
            color: #555;
            margin-top: 2rem;
            margin-bottom: 3rem;
            line-height: 1.6;
            animation: slideInUp 0.8s ease-out 0.1s both;
        }

        .search-container {
            animation: slideInUp 0.8s ease-out 0.2s both;
            margin-bottom: 2.5rem;
        }

        .search-bar {
            max-width: 680px;
            margin: 0 auto;
            display: flex;
            gap: 0.75rem;
            background: #fff;
            backdrop-filter: blur(20px);
            padding: 0.6rem;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .search-bar:hover,
        .search-bar:focus-within {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            background: transparent;
            outline: none;
            color: var(--fg);
        }

        .search-input::placeholder {
            color: #999;
        }

        .search-btn {
            padding: 1rem 1.75rem;
            border-radius: 12px;
            background: var(--fg);
            color: #fff;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-btn:hover {
            background: #222;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .search-btn:active {
            transform: translateY(0);
        }

        .hero-cta {
            animation: slideInUp 0.8s ease-out 0.3s both;
            display: flex;
            gap: 1.2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 1.1rem 2.5rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-hero:hover::before {
            transform: translateX(100%);
        }

        .btn-primary-hero {
            background: var(--fg);
            color: #fff;
            border: 2px solid var(--fg);
        }

        .btn-primary-hero:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-hero {
            background: transparent;
            color: var(--fg);
            border: 2px solid var(--fg);
        }

        .btn-outline-hero:hover {
            background: var(--fg);
            color: #fff;
            transform: translateY(-4px);
        }

        /* Gallery Section */
        .gallery-section {
            padding: 8rem 2rem;
            background: linear-gradient(180deg, #fff 0%, #fafafa 100%);
            position: relative;
            overflow: hidden;
        }

        .gallery-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.02) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .gallery-title {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 2;
            animation: slide-in-down 0.8s ease-out;
        }

        .gallery-title h2 {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
            background: linear-gradient(135deg, #1a1a2e 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: slide-in-down 0.8s ease-out 0.1s both;
        }

        .gallery-title p {
            color: #666;
            font-size: 1.2rem;
            line-height: 1.6;
            animation: slide-in-down 0.8s ease-out 0.2s both;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
            transform: translateZ(0);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .gallery-item:hover {
            transform: translateY(-16px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.12) rotate(2deg);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.7));
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay-text {
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            transform: translateY(10px);
            transition: transform 0.4s ease;
        }

        .gallery-item:hover .gallery-overlay-text {
            transform: translateY(0);
        }

        /* Featured Jobs Section */
        .featured-jobs-section {
            padding: 8rem 2rem;
            background: #fff;
            position: relative;
        }

        .featured-jobs-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.02) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .featured-jobs-title {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 2;
            animation: slide-in-down 0.8s ease-out;
        }

        .featured-jobs-title h2 {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
            color: #000;
            animation: slide-in-down 0.8s ease-out 0.1s both;
        }

        .featured-jobs-title p {
            color: #666;
            font-size: 1.1rem;
            animation: slide-in-down 0.8s ease-out 0.2s both;
        }

        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .job-card {
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            padding: 2.5rem;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--fg), #666);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .job-card:hover {
            transform: translateY(-20px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
            border-color: transparent;
        }

        .job-card:hover::before {
            transform: scaleX(1);
        }

        .job-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--fg);
            transition: color 0.3s ease;
        }

        .job-card:hover h3 {
            color: #000;
        }

        .job-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f0f0f0 0%, #e8e8e8 100%);
            color: var(--fg);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .job-description {
            color: #666;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 2rem;
            border-top: 1px solid #f0f0f0;
            color: #999;
            font-size: 0.95rem;
        }

        .job-location {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
        }

        .job-card:hover .job-location {
            color: var(--fg);
        }

        .job-salary {
            font-weight: 800;
            color: var(--fg);
            font-size: 1.2rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 6rem 2rem;
            position: relative;
            z-index: 2;
        }

        .empty-state p {
            color: #999;
            font-size: 1.2rem;
        }

        /* Image Optimization */
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Performance Optimizations */
        video {
            will-change: transform;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        section {
            will-change: transform;
        }

        /* GPU Acceleration */
        .gallery-item,
        .job-card,
        .gallery-overlay {
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        /* Footer */
        footer {
            background: var(--primary-bg);
            color: var(--primary-text);
            text-align: center;
            padding: 3rem 2rem;
            margin-top: 6rem;
            font-size: 0.95rem;
        }

        /* Animations */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll Reveal Animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.7s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger animation for cards */
        .scroll-reveal:nth-child(1) { transition-delay: 0ms; }
        .scroll-reveal:nth-child(2) { transition-delay: 100ms; }
        .scroll-reveal:nth-child(3) { transition-delay: 200ms; }
        .scroll-reveal:nth-child(4) { transition-delay: 300ms; }
        .scroll-reveal:nth-child(n+5) { transition-delay: 400ms; }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.8rem;
            }

            .hero-content .subtitle {
                font-size: 1.1rem;
            }

            .search-bar {
                flex-direction: column;
            }

            .hero-cta {
                flex-direction: column;
            }

            .btn-hero {
                width: 100%;
            }

            .gallery-grid,
            .jobs-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .featured-jobs-title h2,
            .gallery-title h2 {
                font-size: 2.2rem;
            }

            .job-footer {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        /* Footer Responsive Styles */
        @media (max-width: 1024px) {
            footer .navigation-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 2rem !important;
            }
        }

        @media (max-width: 768px) {
            footer {
                padding: 2rem 1.5rem !important;
            }

            footer .brand-section h3 {
                font-size: 1.5rem !important;
            }

            footer .brand-section p {
                font-size: 0.95rem !important;
            }

            footer .social-icons {
                font-size: 1.3rem !important;
                gap: 0.8rem !important;
            }

            footer .navigation-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
                margin-bottom: 2rem !important;
            }

            footer .nav-column h4 {
                font-size: 1rem !important;
            }

            footer .nav-column ul {
                gap: 0.6rem !important;
            }

            footer .nav-column a {
                font-size: 0.9rem !important;
            }

            footer .divider {
                margin: 2rem 0 !important;
            }

            footer .bottom-section {
                gap: 1rem !important;
            }

            footer .bottom-section span,
            footer .bottom-section p {
                font-size: 0.8rem !important;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 1.5rem 1rem !important;
            }

            footer .brand-section h3 {
                font-size: 1.3rem !important;
                margin-bottom: 1rem !important;
            }

            footer .brand-section p {
                font-size: 0.85rem !important;
                margin-bottom: 1rem !important;
                line-height: 1.5 !important;
            }

            footer .social-icons {
                font-size: 1.1rem !important;
                gap: 0.6rem !important;
            }

            footer .navigation-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
                margin-bottom: 1.5rem !important;
            }

            footer .nav-column h4 {
                font-size: 0.9rem !important;
                margin-bottom: 1rem !important;
            }

            footer .nav-column ul {
                gap: 0.5rem !important;
            }

            footer .nav-column a {
                font-size: 0.85rem !important;
            }

            footer .divider {
                margin: 1.5rem 0 !important;
            }

            footer .bottom-section {
                gap: 0.8rem !important;
            }

            footer .bottom-section span,
            footer .bottom-section p {
                font-size: 0.75rem !important;
            }
        }
    </style>
</head>
<body>
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
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                    @auth
                        @if(!Auth::user()->isAdmin())
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-parallax-bg" id="parallaxBg">
            <video autoplay muted loop playsinline preload="auto">
                <source src="https://videos.pexels.com/video-files/853789/853789-hd_1920_1080_25fps.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="hero-content">
            <h1>Find your next opportunity</h1>
            <p class="subtitle">Connect with amazing companies and advance your career. Browse curated jobs tailored to your skills and goals.</p>

            <div class="search-container">
                <form method="get" action="{{ route('job-postings.index') }}" class="search-bar">
                    <input name="search" value="{{ request('search') }}" type="search" class="search-input" placeholder="Search jobs, companies, skills...">
                    <button class="search-btn" type="submit"><i class="bi bi-search"></i> Search</button>
                </form>
            </div>

            <div class="hero-cta">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.job-postings.create') }}" class="btn-hero btn-outline-hero"><i class="bi bi-plus-circle me-2"></i>Create Job Posting</a>
                        <a href="{{ route('admin.dashboard') }}" class="btn-hero btn-primary-hero"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a>
                    @else
                        <a href="{{ route('job-postings.index') }}" class="btn-hero btn-outline-hero"><i class="bi bi-briefcase me-2"></i>Browse Jobs</a>
                        <a href="{{ route('job-applications.index') }}" class="btn-hero btn-primary-hero"><i class="bi bi-file-earmark me-2"></i>My Applications</a>
                    @endif
                @else
                    <a href="{{ route('auth.login.page') }}" class="btn-hero btn-outline-hero">Login</a>
                    <a href="{{ route('auth.register.page') }}" class="btn-hero btn-primary-hero">Get Started</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Why Choose Elixify Section -->
    <section style="position: relative; padding: 7rem 2rem; overflow: hidden; z-index: 2;">
        <!-- Video Background -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; opacity: 0.12;">
                <source src="https://videos.pexels.com/video-files/3205676/3205676-hd_1920_1080_25fps.mp4" type="video/mp4">
            </video>
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(250,250,250,0.98) 100%);"></div>
        </div>

        <!-- Animated Accent Elements -->
        <div style="position: absolute; top: 10%; left: 5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); animation: float 8s ease-in-out infinite; z-index: 0;"></div>
        <div style="position: absolute; bottom: 10%; right: 5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%); border-radius: 50%; filter: blur(80px); animation: float 12s ease-in-out infinite; z-index: 0;"></div>

        <!-- Content -->
        <div style="position: relative; z-index: 1; max-width: 1400px; margin: 0 auto;">
            <div style="margin-bottom: 5rem;">
                <h2 style="font-size: 2.8rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a2e; line-height: 1.2;">Why job seekers and companies choose Elixify</h2>
                <p style="color: #555; font-size: 1.05rem; line-height: 1.7; max-width: 700px;">We built Elixify because we know what both sides need. Not another generic platform, but a place where real connections lead to real opportunities.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
                <!-- Feature 1 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #1a1a2e; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #f0f0f0;">
                        <i class="bi bi-rocket-takeoff" style="font-size: 1.8rem; color: #fff;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Fast Track Growth</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">Find roles that match your ambitions and move your career forward.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #f0f0f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #1a1a2e;">
                        <i class="bi bi-people-fill" style="font-size: 1.8rem; color: #1a1a2e;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Quality Connections</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">Meet employers and professionals who genuinely value your growth.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #1a1a2e; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #f0f0f0;">
                        <i class="bi bi-lightning-charge-fill" style="font-size: 1.8rem; color: #fff;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Smart Matching</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">We learn what you want and show you opportunities that actually fit.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #f0f0f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #1a1a2e;">
                        <i class="bi bi-shield-lock" style="font-size: 1.8rem; color: #1a1a2e;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Secure & Private</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">Your data stays protected. You control who sees your profile.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #1a1a2e; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #f0f0f0;">
                        <i class="bi bi-globe" style="font-size: 1.8rem; color: #fff;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Global Opportunities</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">Browse roles worldwide with remote and relocation flexibility.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div style="display: flex; gap: 1.5rem;">
                    <div style="width: 56px; height: 56px; background: #f0f0f0; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid #1a1a2e;">
                        <i class="bi bi-graph-up-arrow" style="font-size: 1.8rem; color: #1a1a2e;"></i>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; margin-bottom: 0.5rem; font-size: 1.1rem; color: #1a1a2e;">Career Analytics</h3>
                        <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">Track your journey and understand what's working for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="featured-jobs-section" style="position: relative; overflow: hidden;">
        <!-- Parallax Video Background -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 120%; overflow: hidden; z-index: 0; transform: translateZ(0);" id="jobsParallax">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6; position: absolute; top: 0; left: 0;">
                <source src="https://videos.pexels.com/video-files/3202364/3202364-hd_1920_1080_25fps.mp4" type="video/mp4">
            </video>
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(180deg, rgba(255,255,255,0.5) 0%, rgba(252,252,252,0.5) 50%, rgba(245,245,245,0.5) 100%);"></div>
        </div>

        <!-- Animated Accent Elements -->
        <div style="position: absolute; top: 15%; left: 10%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(0, 0, 0, 0.12) 0%, transparent 70%); border-radius: 50%; filter: blur(50px); animation: float 10s ease-in-out infinite; z-index: 0;"></div>
        <div style="position: absolute; bottom: 15%; right: 8%; width: 350px; height: 350px; background: radial-gradient(circle, rgba(0, 0, 0, 0.12) 0%, transparent 70%); border-radius: 50%; filter: blur(70px); animation: float 14s ease-in-out infinite reverse; z-index: 0;"></div>

        <div style="position: relative; z-index: 2;">
        <div class="featured-jobs-title">
            <h2>Latest Opportunities</h2>
            @if(isset($jobpostings) && $jobpostings->total())
                <p>{{ $jobpostings->total() }} positions available</p>
            @endif
        </div>

        @if(isset($jobpostings) && $jobpostings->count())
            <div class="jobs-grid">
                @foreach($jobpostings as $job)
                    <article class="job-card scroll-reveal">
                        <div class="job-badge">{{ $job->employment_type ?? 'Full-time' }}</div>
                        <h3>{{ $job->title }}</h3>
                        <p class="job-description">{{ \Illuminate\Support\Str::limit($job->description ?? 'Explore this amazing opportunity', 120) }}</p>
                        <div class="job-footer">
                            <div class="job-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $job->location ?? 'Remote' }}</span>
                            </div>
                            @if($job->salary_from)
                                <div class="job-salary">{{ format_ghs($job->salary_from) }}</div>
                            @else
                                <div class="job-salary">Contact for details</div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-6" style="margin-top: 3rem;">
                {{ $jobpostings->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p style="margin-top: 1rem;">No job postings available yet. Check back soon for exciting opportunities!</p>
            </div>
        @endif
        </div>
    </section>

    <!-- Footer with Video Background -->
    <footer style="position: relative; overflow: hidden; background: rgba(0, 0, 0, 0.5); color: #fff; margin-top: 0; backdrop-filter: blur(5px); border-top: none;">
        <!-- Video Background -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; opacity: 0.15;">
                <source src="https://videos.pexels.com/video-files/3250236/3250236-hd_1920_1080_25fps.mp4" type="video/mp4">
            </video>
        </div>

        <!-- Animated Gradient Overlay -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: transparent; z-index: 1;"></div>

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
            <div class="navigation-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: clamp(1rem, 4vw, 2rem); margin-bottom: 2rem; width: 100%;">
                <!-- For Job Seekers -->
                <div class="nav-column" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: clamp(0.8rem, 2.5vw, 0.95rem); color: #fff; text-transform: uppercase; letter-spacing: 0.5px; align-self: center;">Job Seekers</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: clamp(0.8rem, 2vw, 0.9rem); align-items: center; width: 100%; justify-content: center;">
                        <li><a href="{{ route('job-postings.index') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Browse Jobs</a></li>
                        <li><a href="{{ Auth::check() ? route('job-applications.index') : route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">My Applications</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Career Tips</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Profile Builder</a></li>
                    </ul>
                </div>

                <!-- For Companies -->
                <div class="nav-column" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: clamp(0.8rem, 2.5vw, 0.95rem); color: #fff; text-transform: uppercase; letter-spacing: 0.5px; align-self: center;">Companies</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: clamp(0.8rem, 2vw, 0.9rem); align-items: center; width: 100%; justify-content: center;">
                        <li><a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.job-postings.create') : route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Post Job</a></li>
                        <li><a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.dashboard') : route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Dashboard</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Pricing</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Resources</a></li>
                    </ul>
                </div>

                <!-- Legal & Support -->
                <div class="nav-column" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                    <h4 style="font-weight: 700; margin-bottom: 1rem; font-size: clamp(0.8rem, 2.5vw, 0.95rem); color: #fff; text-transform: uppercase; letter-spacing: 0.5px; align-self: center;">Support</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: clamp(0.8rem, 2vw, 0.9rem); align-items: center; width: 100%; justify-content: center;">
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Privacy Policy</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Terms of Service</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Contact Us</a></li>
                        <li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">FAQ</a></li>
                    </ul>
                </div>
            </div>

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
        // Handle session success/logout messages
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#111',
                confirmButtonText: 'Great!',
                background: '#fff',
                color: '#111'
            });
        @endif

        // Welcome alert for authenticated users
        @auth
            const userName = "{{ Auth::user()->fullname }}";
        @endauth

        // Logout confirmation function
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out of your account.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#111',
                cancelButtonColor: '#f0f0f0',
                confirmButtonText: 'Yes, log me out',
                cancelButtonText: 'Cancel',
                background: '#fff',
                color: '#111'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        // Header scroll effect
        const header = document.querySelector('.site-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Parallax scroll effect for multiple sections
        const parallaxElements = [
            { element: document.getElementById('galleryParallax'), speed: 0.4 },
            { element: document.getElementById('jobsParallax'), speed: 0.3 }
        ];

        window.addEventListener('scroll', () => {
            parallaxElements.forEach(({ element, speed }) => {
                if (element) {
                    const scrollY = window.scrollY;
                    const elementTop = element.parentElement.getBoundingClientRect().top + scrollY;
                    const distance = scrollY - elementTop;
                    if (distance < window.innerHeight * 1.5 && distance > -window.innerHeight) {
                        element.style.transform = `translateY(${distance * speed}px) translateZ(0)`;
                    }
                }
            });
        });

        // Parallax effect for hero section
        const parallaxBg = document.getElementById('parallaxBg');
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (parallaxBg && scrollY < window.innerHeight * 1.2) {
                parallaxBg.style.transform = `translateY(${scrollY * 0.5}px)`;
            }
        });

        // Scroll reveal animation with stagger
        const revealElements = document.querySelectorAll('.scroll-reveal');

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -80px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('revealed');
                    }, 0);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealElements.forEach(el => observer.observe(el));

        // Smooth navigation link highlighting
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Form focus effects
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.boxShadow = '0 40px 100px rgba(0, 0, 0, 0.2)';
            });
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.boxShadow = '0 20px 60px rgba(0, 0, 0, 0.12)';
            });
        }

        // Mobile nav collapse on link click
        const navbarCollapse = document.querySelector('.navbar-collapse');
        const navItems = document.querySelectorAll('.navbar-nav .nav-link');
        navItems.forEach(item => {
            item.addEventListener('click', () => {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
                bsCollapse.hide();
            });
        });
    </script>
</body>
</html>
