<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - VK Hotel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #c4a747;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --dark-bg: #1a1a1a;
            --light-bg: #f9f9f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Video Background */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-background video {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.5) 100%);
            z-index: -1;
        }

        /* Floating Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), rgba(196,167,71,0.3));
            filter: blur(40px);
            animation: floatOrb 20s infinite ease-in-out;
            z-index: -1;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            bottom: -150px;
            left: -150px;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        @keyframes floatOrb {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(50px, 50px) scale(1.1);
            }
            50% {
                transform: translate(0, 100px) scale(0.9);
            }
            75% {
                transform: translate(-50px, 50px) scale(1.05);
            }
        }

        /* Main Container */
        .login-container {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            perspective: 1000px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transform-style: preserve-3d;
            animation: cardAppear 0.8s ease-out;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: rotateY(-10deg) translateY(30px);
            }
            to {
                opacity: 1;
                transform: rotateY(0) translateY(0);
            }
        }

        /* Header */
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #b38f3c 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .hotel-icon {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 45px;
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 1;
            animation: bounceIn 1s ease;
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }

        .hotel-icon i {
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
        }

        .login-header h2 {
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
            animation: slideDown 0.8s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            margin-bottom: 0;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Body */
        .login-body {
            padding: 40px;
        }

        /* Session Status */
        .session-status {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .session-status i {
            font-size: 18px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 25px;
            position: relative;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label i {
            color: var(--primary-color);
            margin-right: 8px;
            width: 20px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
            color: #333;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(196, 167, 71, 0.1);
            outline: none;
            transform: scale(1.02);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus + .input-icon {
            transform: translateY(-50%) scale(1.1);
            color: #b38f3c;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        /* Error Messages */
        .error-message {
            margin-top: 8px;
            font-size: 13px;
            color: #dc3545;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: fadeIn 0.3s ease;
            padding-left: 15px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .error-message i {
            font-size: 14px;
        }

        /* Remember Me Checkbox */
        .remember-group {
            margin: 25px 0;
            animation: fadeIn 0.6s ease 0.3s forwards;
            opacity: 0;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .custom-checkbox input:checked {
            transform: scale(1.1);
        }

        .checkbox-label {
            color: #555;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .checkbox-label i {
            color: var(--primary-color);
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 16px 30px;
            background: linear-gradient(135deg, var(--primary-color) 0%, #b38f3c 100%);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease 0.4s forwards;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(196, 167, 71, 0.4);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover i {
            transform: translateX(-5px) rotate(360deg);
        }

        .btn-login i {
            transition: all 0.5s ease;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Forgot Password Link */
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease 0.25s forwards;
            opacity: 0;
        }

        .forgot-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .forgot-link i {
            color: var(--primary-color);
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-color);
        }

        .forgot-link:hover i {
            transform: translateX(3px);
        }

        /* Register Link */
        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            animation: fadeIn 0.6s ease 0.5s forwards;
            opacity: 0;
        }

        .register-link p {
            color: #6c757d;
            font-size: 15px;
            margin-bottom: 0;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .register-link a:hover {
            color: #b38f3c;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        .register-link a:hover i {
            transform: translateX(5px);
        }

        .register-link a i {
            transition: transform 0.3s ease;
        }

        /* Social Login */
        .social-login {
            text-align: center;
            margin-top: 25px;
            animation: fadeIn 0.6s ease 0.6s forwards;
            opacity: 0;
        }

        .social-login p {
            color: #6c757d;
            font-size: 14px;
            position: relative;
            margin-bottom: 20px;
        }

        .social-login p::before,
        .social-login p::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #e9ecef;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: all 0.4s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
        }

        .social-btn:hover::before {
            left: 100%;
        }

        .social-btn.facebook {
            background: #3b5998;
            box-shadow: 0 5px 15px rgba(59, 89, 152, 0.4);
        }

        .social-btn.google {
            background: #db4437;
            box-shadow: 0 5px 15px rgba(219, 68, 55, 0.4);
        }

        .social-btn.twitter {
            background: #1da1f2;
            box-shadow: 0 5px 15px rgba(29, 161, 242, 0.4);
        }

        .social-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Hotel Features */
        .hotel-features {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
            padding: 20px 0 0;
            animation: fadeIn 0.6s ease 0.7s forwards;
            opacity: 0;
        }

        .feature {
            text-align: center;
        }

        .feature i {
            color: var(--primary-color);
            font-size: 20px;
            margin-bottom: 5px;
        }

        .feature span {
            display: block;
            font-size: 12px;
            color: #6c757d;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-body {
                padding: 30px 20px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h2 {
                font-size: 28px;
            }

            .hotel-icon {
                width: 70px;
                height: 70px;
                font-size: 35px;
            }

            .orb-1 {
                width: 200px;
                height: 200px;
            }

            .orb-2 {
                width: 300px;
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay muted loop playsinline>
            <source src="https://player.vimeo.com/external/371837837.sd.mp4?s=5e4f9c6d7a8b9c0d1e2f3a4b5c6d7e8f9a0b1c2d&profile_id=165" type="video/mp4">
            <!-- Fallback for browsers that don't support video -->
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="overlay"></div>

    <!-- Floating Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="hotel-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h2>Welcome Back</h2>
                <p>Sign in to continue your luxury experience</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="session-status">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <div class="input-wrapper">
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   autocomplete="username"
                                   placeholder="Enter your email">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-wrapper">
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Enter your password">
                            <i class="fas fa-lock input-icon"></i>
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Forgot Password Link -->
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                <i class="fas fa-question-circle"></i>
                                Forgot your password?
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endif

                    <!-- Remember Me Checkbox -->
                    <div class="remember-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-label">
                                <i class="fas fa-check-circle"></i>
                                Remember me on this device
                            </span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>

                    <!-- Social Login -->
                    <div class="social-login">
                        <p>Or continue with</p>
                        <div class="social-buttons">
                            <a href="#" class="social-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn google">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-btn twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <div class="register-link">
                        <p>New to VK Hotel? 
                            <a href="{{ route('register') }}">
                                Create an account
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </p>
                    </div>

                    <!-- Hotel Features -->
                    <div class="hotel-features">
                        <div class="feature">
                            <i class="fas fa-wifi"></i>
                            <span>Free WiFi</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-swimmer"></i>
                            <span>Pool</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-dumbbell"></i>
                            <span>Gym</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-utensils"></i>
                            <span>Restaurant</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Password visibility toggle
            $('#togglePassword').click(function() {
                const password = $('#password');
                const type = password.attr('type') === 'password' ? 'text' : 'password';
                password.attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
                
                // Add animation
                $(this).css('transform', 'scale(1.2)');
                setTimeout(() => {
                    $(this).css('transform', 'scale(1)');
                }, 200);
            });

            // Form submission with loading state
            $('#loginForm').on('submit', function() {
                const btn = $('#loginBtn');
                btn.html('<i class="fas fa-spinner fa-spin"></i> Signing In...');
                btn.prop('disabled', true);
            });

            // Auto-hide error messages after 5 seconds
            setTimeout(function() {
                $('.error-message').fadeOut(500);
            }, 5000);

            // Input field animations
            $('.form-control').on('focus', function() {
                $(this).parent().find('.input-icon').css('color', '#b38f3c');
            });

            $('.form-control').on('blur', function() {
                $(this).parent().find('.input-icon').css('color', 'var(--primary-color)');
            });

            // Remember me checkbox animation
            $('#remember_me').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).parent().find('.checkbox-label i').css({
                        'color': '#c4a747',
                        'transform': 'scale(1.2)'
                    });
                } else {
                    $(this).parent().find('.checkbox-label i').css({
                        'color': '#555',
                        'transform': 'scale(1)'
                    });
                }
            });

            // Welcome message for demo
            console.log('%c Welcome to VK Hotel! ', 'background: #c4a747; color: white; font-size: 16px; padding: 5px; border-radius: 5px;');
        });
    </script>

    <!-- SweetAlert2 for better alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#c4a747',
            background: 'rgba(255,255,255,0.95)',
            backdrop: `
                rgba(0,0,0,0.4)
                url("https://media.giphy.com/media/3o7abKhOpu0NwenH3O/giphy.gif")
                left top
                no-repeat
            `
        });
    </script>
    @endif
</body>
</html>