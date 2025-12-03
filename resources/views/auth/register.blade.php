<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register · Elixify</title>
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

		<script>
			// Role selection card handler (click + keyboard)
			(function(){
				const roleInput = document.querySelector('#role');
				if (!roleInput) return;
				const cards = document.querySelectorAll('.role-card');
				cards.forEach((card) => {
					card.setAttribute('tabindex', '0');
					card.addEventListener('click', function() {
						cards.forEach(c => c.classList.remove('selected'));
						this.classList.add('selected');
						roleInput.value = this.getAttribute('data-role');
					});
					card.addEventListener('keydown', function(e) {
						if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); this.click(); }
					});
				});
				// set initial value if server preselected a card
				const initial = document.querySelector('.role-card.selected');
				if (initial && !roleInput.value) roleInput.value = initial.getAttribute('data-role');
			})();

			@if($errors->any())
				Swal.fire({
					title: 'Registration Error',
					text: 'Please check your information and try again.',
					icon: 'error',
					confirmButtonColor: '#111',
					confirmButtonText: 'Fix Issues'
				});
			@endif

			// Add client-side validation feedback
			const form = document.querySelector('form');
			if (form) {
				form.addEventListener('submit', function(e) {
					const role = document.querySelector('#role').value;
					const fullname = document.querySelector('#fullname').value;
					const email = document.querySelector('#email').value;
					const password = document.querySelector('#password').value;
					const passwordConfirm = document.querySelector('#password_confirmation').value;
					const contact = document.querySelector('#contact').value;
					const address = document.querySelector('#address').value;

					if (!role || !fullname || !email || !password || !passwordConfirm || !contact || !address) {
						e.preventDefault();
						Swal.fire({
							title: 'Missing Information',
							text: 'Please fill in all required fields.',
							icon: 'warning',
							confirmButtonColor: '#111'
						});
						return false;
					}

					if (password !== passwordConfirm) {
						e.preventDefault();
						Swal.fire({
							title: 'Password Mismatch',
							text: 'Your passwords do not match.',
							icon: 'warning',
							confirmButtonColor: '#111'
						});
						return false;
					}

					if (password.length < 6) {
						e.preventDefault();
						Swal.fire({
							title: 'Password Too Short',
							text: 'Password must be at least 6 characters long.',
							icon: 'warning',
							confirmButtonColor: '#111'
						});
						return false;
					}
				});
			}
		</script>
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

		.auth-wrap{ position:relative; z-index:2; width:100%; max-width:560px; padding:1rem }
		.card-auth{ position:relative; overflow:hidden; background:rgba(255, 255, 255, 0.1); color:#111; border-radius:20px; padding:2.2rem; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border:1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15), inset 0 0 20px rgba(255, 255, 255, 0.1); }

		.card-media{ position:absolute; inset:0; z-index:0; display:none; }
		.card-media img, .card-media video{ width:100%; height:100%; object-fit:cover; display:block; filter:grayscale(100%) contrast(0.95) brightness(0.98) }
		.card-overlay{ position:absolute; inset:0; background:transparent; z-index:1 }
		.card-content{ position:relative; z-index:2 }

		.brand{ font-weight:800; font-size:1.6rem }
		.subtitle{ color:var(--muted); margin-top:0.25rem; font-size:0.95rem }

		.row-gap{ display:grid; grid-template-columns:1fr 1fr; gap:1rem }
		.form-label{ display:block; font-size:0.78rem; font-weight:700; color:#222; margin-bottom:0.45rem }
		.form-input{ width:100%; padding:0.9rem; border-radius:8px; border:1px solid #e9e9e9; background:#fafafa; color:#111 }
		.form-input::placeholder{ color:#9b9b9b }

		.helper-text{ font-size:0.78rem; color:var(--muted); margin-top:0.4rem }

		.btn-submit{ width:100%; padding:0.95rem; border-radius:8px; border:none; background:#111; color:#fff; font-weight:700; margin-top:0.5rem }

		.login-line{ text-align:center; margin-top:1rem; color:var(--muted) }
		.login-line a{ color:#111; font-weight:700; text-decoration:none }

		@media (max-width:768px){ .row-gap{ grid-template-columns:1fr } }
		@media (max-width:480px){ .card-auth{ padding:1.2rem } .brand{ font-size:1.3rem } }

		/* Vanta.js Background */
		#background-canvas {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100vh;
			z-index: 0;
		}

		/* Ensure header is visible */
		.site-header {
			position: relative !important;
			z-index: 1000 !important;
		}

		/* Ensure main content and footer are visible */
		header, main, .container, footer, .footer {
			position: relative;
			z-index: 1;
		}

		/* Footer specific z-index */
		footer {
			z-index: 10 !important;
		}
	</style>
</head>
<body>
	<div id="background-canvas"></div>
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
					<li class="nav-item"><a class="nav-link" href="{{ route('auth.login.page') }}">Sign In</a></li>
				</ul>
			</div>
		</div>
	</header>

	<div class="auth-page-content">
		<div class="auth-wrap">
		<div class="card-auth">
			<div class="card-media"></div>
			<div class="card-overlay"></div>
			<div class="card-content">
				<div class="brand">Elixify</div>
				<div class="subtitle">Join Ghana's job marketplace — it's free</div>

				@if($errors->any())
					<div class="error" style="background:#fff1f1;border:1px solid #ffd6d6;color:#721c24;padding:0.9rem;border-radius:8px;margin-bottom:1rem">
						<strong>There was an issue.</strong>
						<ul>
							@foreach($errors->all() as $err)
								<li>{{ $err }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form method="POST" action="{{ route('auth.register') }}" novalidate>
					@csrf

					<div class="row-gap mb-3">
						<div>
							<label class="form-label">Account Type</label>
							<input type="hidden" id="role" name="role" value="{{ old('role') }}" required>

							<div class="role-selection" role="list" style="display:flex;gap:0.6rem;margin-top:0.6rem">
								<div class="role-card" tabindex="0" data-role="job_seeker" aria-pressed="false" role="listitem">
									<div class="role-card-icon"><i class="bi bi-person-check-fill"></i></div>
									<div class="role-card-title">Job Seeker</div>
									<div class="role-card-desc">Search and apply to jobs</div>
									<div class="role-card-check" aria-hidden>✓</div>
								</div>

								<div class="role-card" tabindex="0" data-role="admin" aria-pressed="false" role="listitem">
									<div class="role-card-icon"><i class="bi bi-clipboard-check-fill"></i></div>
									<div class="role-card-title">Admin / Recruiter</div>
									<div class="role-card-desc">Post jobs and manage applicants</div>
									<div class="role-card-check" aria-hidden>✓</div>
								</div>
							</div>

							@error('role')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div></div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="fullname" class="form-label">Full name</label>
							<input type="text" id="fullname" name="fullname" class="form-input" value="{{ old('fullname') }}" required>
							@error('fullname')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="email" class="form-label">Email</label>
							<input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
							@error('email')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="password" class="form-label">Password</label>
							<input type="password" id="password" name="password" class="form-input" required>
							@error('password')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="password_confirmation" class="form-label">Confirm Password</label>
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
						</div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="contact" class="form-label">Contact</label>
							<input type="tel" id="contact" name="contact" class="form-input" value="{{ old('contact') }}" required>
							@error('contact')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="address" class="form-label">Address</label>
							<input type="text" id="address" name="address" class="form-input" value="{{ old('address') }}" required>
							@error('address')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<button type="submit" class="btn-submit">Create Account</button>
				</form>

				<style>
					.role-card{background:#fff;border-radius:10px;padding:0.6rem 0.8rem;display:flex;flex-direction:column;align-items:flex-start;gap:6px;border:1px solid rgba(0,0,0,0.06);cursor:pointer;box-shadow:0 2px 6px rgba(16,24,40,0.04);min-width:170px}
					.role-card:focus{outline:2px solid #6b46c1;outline-offset:2px}
					.role-card[aria-pressed="true"]{border-color:#6b46c1;background:linear-gradient(180deg,rgba(107,70,193,0.06),#fff)}
					.role-card-icon{font-size:1.2rem;color:#6b46c1}
					.role-card-title{font-weight:600;font-size:0.95rem}
					.role-card-desc{font-size:0.78rem;color:#556167}
					.role-card-check{margin-left:auto;color:#2f855a;font-weight:700;display:none}
					.role-card[aria-pressed="true"] .role-card-check{display:block}
				</style>

				<script>
					(function(){
						var cards = document.querySelectorAll('.role-card');
						var roleInput = document.getElementById('role');
						var initialRole = @json(old('role')) || '';
						function selectCard(card){
							cards.forEach(function(c){ c.setAttribute('aria-pressed','false'); });
							card.setAttribute('aria-pressed','true');
							var val = card.getAttribute('data-role');
							if(roleInput) roleInput.value = val;
						}
						cards.forEach(function(card){
							card.addEventListener('click', function(){ selectCard(card); });
							card.addEventListener('keydown', function(e){ if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); selectCard(card); }});
						});
						if(initialRole){ var pre = document.querySelector('.role-card[data-role="'+initialRole+'"]'); if(pre) selectCard(pre); }
					})();
				</script>

				<div class="login-line">Already have an account? <a href="{{ route('auth.login.page') }}">Sign In</a></div>
			</div>
		</div>
	</div>
	</div>
	<script>
		@if($errors->any())
			Swal.fire({
				title: 'Registration Error',
				text: 'Please check your information and try again.',
				icon: 'error',
				confirmButtonColor: '#111',
				confirmButtonText: 'Fix Issues',
				background: '#fff',
				color: '#111'
			});
		@endif

		// Add client-side validation feedback
		const form = document.querySelector('form');
		if (form) {
			form.addEventListener('submit', function(e) {
				const role = document.querySelector('#role').value;
				const fullname = document.querySelector('#fullname').value;
				const email = document.querySelector('#email').value;
				const password = document.querySelector('#password').value;
				const passwordConfirm = document.querySelector('#password_confirmation').value;
				const contact = document.querySelector('#contact').value;
				const address = document.querySelector('#address').value;

				if (!role || !fullname || !email || !password || !passwordConfirm || !contact || !address) {
					e.preventDefault();
					Swal.fire({
						title: 'Missing Information',
						text: 'Please fill in all required fields.',
						icon: 'warning',
						confirmButtonColor: '#111',
						background: '#fff',
						color: '#111'
					});
					return false;
				}

				if (password !== passwordConfirm) {
					e.preventDefault();
					Swal.fire({
						title: 'Password Mismatch',
						text: 'Your passwords do not match.',
						icon: 'warning',
						confirmButtonColor: '#111',
						background: '#fff',
						color: '#111'
					});
					return false;
				}

				if (password.length < 6) {
					e.preventDefault();
					Swal.fire({
						title: 'Password Too Short',
						text: 'Password must be at least 6 characters long.',
						icon: 'warning',
						confirmButtonColor: '#111',
						background: '#fff',
						color: '#111'
					});
					return false;
				}
			});
		}
	</script>

	<footer style="position: relative; overflow: hidden; background: rgba(0, 0, 0, 0.5); color: #fff; margin-top: 0; backdrop-filter: blur(5px);">
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
						<li><a href="{{ route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">My Applications</a></li>
						<li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Career Tips</a></li>
						<li><a href="#" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Profile Builder</a></li>
					</ul>
				</div>

				<!-- For Companies -->
				<div class="nav-column" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
					<h4 style="font-weight: 700; margin-bottom: 1rem; font-size: clamp(0.8rem, 2.5vw, 0.95rem); color: #fff; text-transform: uppercase; letter-spacing: 0.5px; align-self: center;">Companies</h4>
					<ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem; font-size: clamp(0.8rem, 2vw, 0.9rem); align-items: center; width: 100%; justify-content: center;">
						<li><a href="{{ route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Post Job</a></li>
						<li><a href="{{ route('auth.login.page') }}" style="color: #fff; text-decoration: none; transition: all 0.3s; display: inline-block;" onmouseover="this.style.color='#60a5fa'; this.style.paddingLeft='0.5rem';" onmouseout="this.style.color='#fff'; this.style.paddingLeft='0';">Dashboard</a></li>
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
	<script src="{{ asset('js/interactive-background.js') }}"></script>
	<script>
		@if($errors->any())
			Swal.fire({
				title: 'Registration Error',
				text: 'Please check your information and try again.',
				icon: 'error',
				confirmButtonColor: '#111',
				confirmButtonText: 'Fix Issues'
			});
		@endif

		// Add client-side validation feedback
		const form = document.querySelector('form');
		if (form) {
			form.addEventListener('submit', function(e) {
				const role = document.querySelector('#role').value;
				const fullname = document.querySelector('#fullname').value;
				const email = document.querySelector('#email').value;
				const password = document.querySelector('#password').value;
				const passwordConfirm = document.querySelector('#password_confirmation').value;
				const contact = document.querySelector('#contact').value;
				const address = document.querySelector('#address').value;

				if (!role || !fullname || !email || !password || !passwordConfirm || !contact || !address) {
					e.preventDefault();
					Swal.fire({
						title: 'Missing Information',
						text: 'Please fill in all required fields.',
						icon: 'warning',
						confirmButtonColor: '#111'
					});
					return false;
				}

				if (password !== passwordConfirm) {
					e.preventDefault();
					Swal.fire({
						title: 'Password Mismatch',
						text: 'Your passwords do not match.',
						icon: 'warning',
						confirmButtonColor: '#111'
					});
					return false;
				}

				if (password.length < 6) {
					e.preventDefault();
					Swal.fire({
						title: 'Password Too Short',
						text: 'Password must be at least 6 characters long.',
						icon: 'warning',
						confirmButtonColor: '#111'
					});
					return false;
				}
			});
		}
	</script>
</body>
</html>
