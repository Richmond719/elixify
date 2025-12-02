<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register · Elixify</title>
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

		.auth-wrap{ position:relative; z-index:2; width:100%; max-width:640px; padding:1rem }
		.card-auth{ position:relative; overflow:hidden; background:#fff url('/img/auth-form-bg.svg') center/cover no-repeat; color:#111; border-radius:12px; padding:2.2rem; box-shadow:0 10px 30px rgba(0,0,0,0.4); border:1px solid rgba(0,0,0,0.06) }

		.card-media{ position:absolute; inset:0; z-index:0 }
		.card-media img, .card-media video{ width:100%; height:100%; object-fit:cover; display:block; filter:grayscale(100%) contrast(0.95) brightness(0.98) }
		.card-overlay{ position:absolute; inset:0; background:rgba(255,255,255,0.86); z-index:1 }
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
					<li class="nav-item"><a class="nav-link" href="{{ route('auth.login.page') }}">Sign In</a></li>
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
							<label for="role" class="form-label">Account Type</label>
							<select id="role" name="role" required class="form-input" style="cursor:pointer;padding:0.9rem">
								<option value="">Select account type...</option>
								<option value="job_seeker" {{ old('role') === 'job_seeker' ? 'selected' : '' }}>Job Seeker</option>
								<option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin/Recruiter</option>
							</select>
							@error('role')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div></div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="fullname" class="form-label">Full name</label>
							<input id="fullname" type="text" name="fullname" value="{{ old('fullname') }}" required autofocus placeholder="Kwame Asante" class="form-input">
							@error('fullname')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="email" class="form-label">Email</label>
							<input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="kwame@example.com" class="form-input">
							@error('email')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="password" class="form-label">Password</label>
							<input id="password" type="password" name="password" required placeholder="Choose a secure password" class="form-input">
							<div class="helper-text">At least 6 characters</div>
							@error('password')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="password_confirmation" class="form-label">Confirm Password</label>
							<input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repeat your password" class="form-input">
							@error('password_confirmation')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<div class="row-gap mb-3">
						<div>
							<label for="contact" class="form-label">Phone (Ghana)</label>
							<input id="contact" type="text" name="contact" value="{{ old('contact') }}" required placeholder="0201234567 or +233201234567" class="form-input">
							<div class="helper-text">Format: 024XXXXXXX or +233XXXXXXXXX</div>
							@error('contact')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label for="address" class="form-label">Location</label>
							<input id="address" type="text" name="address" value="{{ old('address') }}" required placeholder="e.g., Accra, Kumasi, Tema" class="form-input">
							@error('address')
								<div style="color:#d32f2f;font-size:0.78rem;margin-top:0.3rem">{{ $message }}</div>
							@enderror
						</div>
					</div>

					<button type="submit" class="btn-submit">Create account</button>
				</form>

				<div class="login-line">Already registered? <a href="{{ route('auth.login.page') }}">Sign in</a></div>
			</div>
		</div>
	</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
