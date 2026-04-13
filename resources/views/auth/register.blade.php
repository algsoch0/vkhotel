<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | VK Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --vk-charcoal: #0b1320;
            --vk-indigo: #1e1b4b;
            --vk-gold: #c59d3f;
            --vk-bg: #f8fafc;
            --vk-line: #cbd5e1;
        }
        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at 15% 15%, rgba(197, 157, 63, 0.25), transparent 35%),
                        radial-gradient(circle at 85% 85%, rgba(30, 27, 75, 0.28), transparent 38%),
                        linear-gradient(140deg, #0b1320, #172554 55%, #1e293b);
            display: grid;
            place-items: center;
            padding: 1.5rem;
        }
        .shell {
            width: 100%;
            max-width: 1080px;
            border-radius: 24px;
            background: #ffffff;
            box-shadow: 0 26px 70px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
        }
        .panel {
            padding: 2.7rem;
            background: linear-gradient(160deg, #0f172a, #111827 45%, #1e293b);
            color: #e2e8f0;
        }
        .panel h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
        }
        .panel .chip {
            display: inline-block;
            background: rgba(197, 157, 63, 0.22);
            border: 1px solid rgba(250, 204, 21, 0.25);
            color: #fde68a;
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
            margin-bottom: 1rem;
            font-size: 0.82rem;
        }
        .panel-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.85rem;
            margin-top: 1.5rem;
        }
        .panel-item {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 0.85rem;
            font-size: 0.9rem;
        }
        .form-wrap {
            background: var(--vk-bg);
            padding: 2.4rem;
        }
        .form-wrap h2 {
            font-family: 'Playfair Display', serif;
            color: var(--vk-charcoal);
            margin-bottom: 0.4rem;
        }
        .form-control {
            border: 1px solid var(--vk-line);
            border-radius: 12px;
            padding: 0.75rem 0.9rem;
        }
        .form-control:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 0.2rem rgba(29, 78, 216, 0.12);
        }
        .btn-register {
            background: linear-gradient(135deg, #d4af37, #b9852b);
            color: #111827;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.78rem 1rem;
        }
        .btn-register:hover { color: #111827; }
        .sub-link { color: #475569; text-decoration: none; }
        .sub-link:hover { color: #111827; }
        @media (max-width: 960px) {
            .shell { grid-template-columns: 1fr; }
            .panel, .form-wrap { padding: 2rem; }
            .panel-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="shell">
    <section class="panel">
        <span class="chip">Join VK Hotel</span>
        <h1>Create Your Guest Account</h1>
        <p>Sign up once and manage all bookings, guest details, and stay preferences from one dashboard.</p>

        <div class="panel-grid">
            <div class="panel-item"><i class="fa-solid fa-id-card"></i> Smart guest profile</div>
            <div class="panel-item"><i class="fa-solid fa-calendar-check"></i> Fast repeat booking</div>
            <div class="panel-item"><i class="fa-solid fa-receipt"></i> Reservation history</div>
            <div class="panel-item"><i class="fa-solid fa-headset"></i> Priority support</div>
        </div>
    </section>

    <section class="form-wrap">
        <h2>Sign Up</h2>
        <p class="text-muted mb-4">Fill out your details to get started.</p>

        <form method="POST" action="{{ route('register') }}" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label fw-semibold" for="name">Full Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="form-control @error('name') is-invalid @enderror">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" for="phone">Phone</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="+1 234 567 890">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" for="email">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold" for="address">Address</label>
                <textarea id="address" name="address" rows="2" class="form-control @error('address') is-invalid @enderror" placeholder="City, State, Country">{{ old('address') }}</textarea>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" for="password">Password</label>
                <input id="password" name="password" type="password" required class="form-control @error('password') is-invalid @enderror">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="form-control">
            </div>

            <div class="col-12 d-grid mt-2">
                <button type="submit" class="btn btn-register">Create Account</button>
            </div>

            <div class="col-12 text-center text-muted mt-2">
                Already registered? <a href="{{ route('login') }}" class="sub-link fw-semibold">Sign in</a>
            </div>

            <div class="col-12 text-center">
                <a href="{{ route('home') }}" class="sub-link">Back to Website</a>
            </div>
        </form>
    </section>
</div>
</body>
</html>
