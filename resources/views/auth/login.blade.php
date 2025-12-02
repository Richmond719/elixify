<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login · Elixify</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
	<style>
		:root { --bg-overlay: rgba(0,0,0,0.55); --muted:#6b6b6b; }
		* { box-sizing: border-box; margin:0; padding:0 }
		html,body { height:100%; }
		body {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			min-height:100vh;
			display:flex; align-items:center; justify-content:center;
			background: #000 url('/img/auth-bg.jpg') center/cover no-repeat fixed;
			color: #111;
		}
		/* ensure background is monochrome */
		body::before{
			content:''; position:fixed; inset:0; z-index:0;
			background:var(--bg-overlay);
			mix-blend-mode: normal;
			filter: grayscale(100%);
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
