<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | VK Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --vk-night: #0f172a;
            --vk-ink: #1e293b;
            --vk-gold: #c8a851;
            --vk-mist: #f8fafc;
            --vk-blue: #1d4ed8;
        }
        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at 10% 15%, rgba(29, 78, 216, 0.25), transparent 35%),
                        radial-gradient(circle at 90% 80%, rgba(200, 168, 81, 0.35), transparent 35%),
                        linear-gradient(130deg, #020617, #0f172a 40%, #172554);
            color: #0f172a;
            display: grid;
            place-items: center;
            padding: 1.5rem;
        }
        .auth-shell {
            width: 100%;
            max-width: 980px;
            border-radius: 26px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.97);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .auth-brand {
            background: linear-gradient(155deg, var(--vk-night), #111827 45%, #1e293b);
            color: #e2e8f0;
            padding: 3rem;
            position: relative;
        }
        .auth-brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
        }
        .auth-brand .badge {
            background: rgba(200, 168, 81, 0.2);
            color: #fde68a;
            border: 1px solid rgba(253, 230, 138, 0.35);
            margin-bottom: 1.25rem;
        }
        .auth-brand ul {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0;
        }
        .auth-brand li {
            margin-bottom: 0.75rem;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .auth-brand i {
            color: #facc15;
        }
        .auth-form {
            padding: 3rem;
            background: var(--vk-mist);
        }
        .auth-form h2 {
            font-family: 'Playfair Display', serif;
            color: var(--vk-ink);
            margin-bottom: 0.35rem;
        }
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 0.9rem;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: var(--vk-blue);
            box-shadow: 0 0 0 0.2rem rgba(29, 78, 216, 0.15);
        }
        .btn-vk {
            background: linear-gradient(135deg, #d4af37, #b9852b);
            border: none;
            color: #111827;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.75rem 1rem;
        }
        .btn-vk:hover { color: #111827; }
        .link-muted {
            color: #475569;
            text-decoration: none;
        }
        .link-muted:hover { color: #1e293b; }
        @media (max-width: 900px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-brand { padding: 2rem; }
            .auth-form { padding: 2rem; }
        }
    </style>
</head>
<body>
<div class="auth-shell">
    <aside class="auth-brand">
        <span class="badge rounded-pill px-3 py-2">VK Hotel Signature Access</span>
        <h1>Welcome Back</h1>
        <p class="mb-0">Access your bookings, guest profile, loyalty-ready stay history, and premium support options.</p>
        <ul>
            <li><i class="fa-solid fa-circle-check"></i> View reservation status live</li>
            <li><i class="fa-solid fa-circle-check"></i> Manage cancellations from your dashboard</li>
            <li><i class="fa-solid fa-circle-check"></i> Fast rebooking in under 60 seconds</li>
        </ul>
    </aside>

    <main class="auth-form">
        <h2>Sign In</h2>
        <p class="text-muted mb-4">Use your registered account credentials.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="row g-3">
            @csrf
            <div class="col-12">
                <label class="form-label fw-semibold" for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" for="password">Password</label>
                <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="link-muted" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <div class="col-12 d-grid">
                <button type="submit" class="btn btn-vk">Login to Dashboard</button>
            </div>

            <div class="col-12 text-center text-muted">
                New guest? <a class="link-muted fw-semibold" href="{{ route('register') }}">Create account</a>
            </div>

            <div class="col-12 text-center">
                <a class="link-muted" href="{{ route('home') }}">Back to Website</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
