<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login · Elixify</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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

		/* Auth page specific styles */
		.auth-page-content {
			flex: 1;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 2rem 0;
			min-height: calc(100vh - 300px);
		}

		body {
			display: flex;
			flex-direction: column;
		}

		.auth-wrap{ position:relative; z-index:2; width:100%; max-width:520px; padding:1rem; }

		.card-auth{
			position:relative; overflow:hidden;
			background: #fff url('/img/auth-form-bg.svg') center/cover no-repeat;
			color:#111; border-radius:12px; padding:2.2rem; box-shadow:0 10px 30px rgba(0,0,0,0.4);
			border: 1px solid rgba(0,0,0,0.06);
		}

		.card-media{ position:absolute; inset:0; z-index:0 }
		.card-media img, .card-media video{ width:100%; height:100%; object-fit:cover; display:block; filter:grayscale(100%) contrast(0.95) brightness(0.98) }
		.card-overlay{ position:absolute; inset:0; background:rgba(255,255,255,0.86); z-index:1 }
		.card-content{ position:relative; z-index:2 }

		.brand{ font-weight:800; font-size:1.6rem; letter-spacing:0.2px; }
		.subtitle{ color:var(--muted); margin-top:0.25rem; font-size:0.95rem }

		.form-label{ display:block; font-size:0.78rem; font-weight:700; color:#222; margin-bottom:0.45rem; }
		.form-input{ width:100%; padding:0.9rem; border-radius:8px; border:1px solid #e9e9e9; background:#fafafa; color:#111; transition:box-shadow .15s, border-color .15s }
		.form-input::placeholder{ color:#9b9b9b }
		.form-input:focus{ outline:none; border-color:#111; box-shadow:0 4px 14px rgba(0,0,0,0.06) }

		.meta-row{ display:flex; justify-content:space-between; align-items:center; margin:1rem 0; font-size:0.9rem }
		.meta-row .remember{ display:flex; gap:0.5rem; align-items:center; color:#333 }
		.meta-row a{ color:#333; text-decoration:none }
		.meta-row a:hover{ text-decoration:underline }

		.btn-submit{ width:100%; padding:0.95rem; border-radius:8px; border: none; background:#111; color:#fff; font-weight:700 }
		.btn-submit:hover{ opacity:0.95 }

		.alt-line{ text-align:center; margin-top:1.5rem; font-size:0.95rem; color:var(--muted); }
		.alt-line a{ color:#111; font-weight:700; text-decoration:none }
		.alt-line a:hover{ text-decoration:underline }

		.error{ background: #fff1f1; border:1px solid #ffd6d6; color:#721c24; padding:0.9rem; border-radius:8px; margin-bottom:1rem }

		@media (max-width:480px){ .card-auth{ padding:1.2rem } .brand{ font-size:1.3rem } }
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
					<li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ url('/job-postings') }}">Browse Jobs</a></li>
					<li class="nav-item"><a class="nav-link" href="{{ route('auth.register.page') }}">Register</a></li>
				</ul>
			</div>
		</div>
	</header>

	<div class="auth-page-content">
		<div class="auth-wrap">
			<div class="card-auth">
			<div class="card-media">
				<video autoplay muted loop playsinline preload="auto">
					<source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div>
		<div class="card-overlay"></div>
		<div class="card-content">
			<div class="brand">Elixify</div>
			<div class="subtitle">Welcome back — Sign in as Admin or Job Seeker</div>

			@if(session('status'))
				<div class="error">{{ session('status') }}</div>
			@endif

			@if($errors->any())
				<div class="error">
					<strong>There was an issue.</strong>
					<ul>
						@foreach($errors->all() as $err)
							<li>{{ $err }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form method="POST" action="{{ route('auth.login') }}" novalidate>
				@csrf

			<div class="mb-3">
				<label for="role" class="form-label">Select Role</label>
				<select id="role" name="role" required class="form-input" style="cursor: pointer;">
					<option value="">-- Choose your role --</option>
					<option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
					<option value="job_seeker" {{ old('role') === 'job_seeker' ? 'selected' : '' }}>Job Seeker</option>
				</select>
				@error('role')
					<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="email" class="form-label">Email</label>
				<input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="your@email.com" class="form-input">
				@error('email')
					<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
				@enderror
			</div>

			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input id="password" type="password" name="password" required placeholder="Enter your password" class="form-input">
				@error('password')
					<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
				@enderror
			</div>

			<div class="meta-row">
				<label class="remember"><input type="checkbox" name="remember"> <span>Remember me</span></label>
				<a href="{{ url('/password/reset') }}">Forgot password?</a>
			</div>

			<button type="submit" class="btn-submit">Sign In</button>
		</form>

		<div class="alt-line">New to Elixify? <a href="{{ route('auth.register.page') }}">Create a free account</a></div>
			</div>
		</div>
	</div>
	</div>

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
						<li><a href="{{ route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">My Applications</a></li>
						<li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Career Tips</a></li>
						<li><a href="#" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Profile Builder</a></li>
					</ul>
				</div>

				<!-- For Companies -->
				<div class="nav-column" style="text-align: center;">
					<h4 style="font-weight: 700; margin-bottom: 1rem; font-size: 0.95rem; color: #60a5fa; text-transform: uppercase; letter-spacing: 0.5px;">Companies</h4>
					<ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: 0.9rem;">
						<li><a href="{{ route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Post Job</a></li>
						<li><a href="{{ route('auth.login.page') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='0';">Dashboard</a></li>
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
		@if($errors->any())
			Swal.fire({
				title: 'Login Failed',
				text: 'Please check your credentials and try again.',
				icon: 'error',
				confirmButtonColor: '#111',
				confirmButtonText: 'Try Again'
			});
		@endif
	</script>
</body>
</html>
