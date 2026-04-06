<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - VK Hotel</title>

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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: -2;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            overflow: hidden;
        }

        .animated-bg span {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }

        .animated-bg span:nth-child(1) {
            left: 10%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .animated-bg span:nth-child(2) {
            left: 20%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .animated-bg span:nth-child(3) {
            left: 25%;
            width: 40px;
            height: 40px;
            animation-delay: 4s;
        }

        .animated-bg span:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .animated-bg span:nth-child(5) {
            left: 70%;
            width: 50px;
            height: 50px;
            animation-delay: 0s;
        }

        .animated-bg span:nth-child(6) {
            left: 80%;
            width: 70px;
            height: 70px;
            animation-delay: 3s;
        }

        /* Main Card */
        .register-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 10;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .register-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #b38f3c 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .hotel-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.5);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .register-header h2 {
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .register-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            margin-bottom: 0;
        }

        /* Body */
        .register-body {
            padding: 40px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 25px;
            position: relative;
            animation: fadeInRight 0.5s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
            padding: 15px 20px;
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
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #28a745;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            pointer-events: none;
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
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Error Messages */
        .error-message {
            margin-top: 8px;
            font-size: 13px;
            color: #dc3545;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-message i {
            font-size: 14px;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 10px;
        }

        .strength-bar {
            height: 5px;
            background: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .strength-text {
            font-size: 12px;
            text-align: right;
            margin-bottom: 10px;
        }

        /* Password Rules */
        .password-rules {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            margin-top: 10px;
            font-size: 12px;
        }

        .rule {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .rule:last-child {
            margin-bottom: 0;
        }

        .rule i {
            width: 16px;
            font-size: 12px;
        }

        .rule.valid {
            color: #28a745;
        }

        .rule.valid i {
            color: #28a745;
        }

        .rule.invalid {
            color: #6c757d;
        }

        .rule.invalid i {
            color: #6c757d;
        }

        /* Terms Checkbox */
        .terms-group {
            margin: 25px 0;
            animation: fadeIn 0.5s ease-out 0.5s forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .custom-checkbox input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .checkbox-label {
            color: #555;
            font-size: 14px;
        }

        .checkbox-label a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .checkbox-label a:hover {
            color: #b38f3c;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit {
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
            animation: fadeInUp 0.5s ease-out 0.6s forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
            from {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(196, 167, 71, 0.4);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .btn-submit:hover i {
            transform: translateX(-5px);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            animation: fadeIn 0.5s ease-out 0.7s forwards;
            opacity: 0;
        }

        .login-link p {
            color: #6c757d;
            font-size: 15px;
            margin-bottom: 0;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .login-link a:hover {
            color: #b38f3c;
        }

        .login-link a:hover::after {
            width: 100%;
        }

        /* Social Login */
        .social-login {
            text-align: center;
            margin-top: 25px;
            animation: fadeIn 0.5s ease-out 0.8s forwards;
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
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-btn.facebook {
            background: #3b5998;
        }

        .social-btn.google {
            background: #db4437;
        }

        .social-btn.twitter {
            background: #1da1f2;
        }

        .social-btn:hover {
            transform: translateY(-5px) rotate(360deg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #b38f3c 100%);
            color: white;
            border: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 30px;
        }

        .modal-body h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .modal-body p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .register-body {
                padding: 30px 20px;
            }

            .register-header {
                padding: 30px 20px;
            }

            .register-header h2 {
                font-size: 28px;
            }

            .hotel-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="hotel-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h2>Welcome to VK Hotel</h2>
                <p>Create your account to start your luxury experience</p>
            </div>

            <!-- Body -->
            <div class="register-body">
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Full Name
                        </label>
                        <div class="input-wrapper">
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Enter your full name">
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        @error('name')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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
                                   autocomplete="new-password"
                                   placeholder="Create a password">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-bar-fill" id="strengthBar"></div>
                            </div>
                            <div class="strength-text" id="strengthText"></div>
                        </div>

                        <!-- Password Rules -->
                        <div class="password-rules" id="passwordRules">
                            <div class="rule" id="lengthRule">
                                <i class="fas fa-circle"></i>
                                <span>At least 8 characters</span>
                            </div>
                            <div class="rule" id="uppercaseRule">
                                <i class="fas fa-circle"></i>
                                <span>At least one uppercase letter</span>
                            </div>
                            <div class="rule" id="lowercaseRule">
                                <i class="fas fa-circle"></i>
                                <span>At least one lowercase letter</span>
                            </div>
                            <div class="rule" id="numberRule">
                                <i class="fas fa-circle"></i>
                                <span>At least one number</span>
                            </div>
                            <div class="rule" id="specialRule">
                                <i class="fas fa-circle"></i>
                                <span>At least one special character</span>
                            </div>
                        </div>

                        @error('password')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Confirm Password
                        </label>
                        <div class="input-wrapper">
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="form-control" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Confirm your password">
                            <i class="fas fa-check-circle input-icon" id="confirmIcon"></i>
                        </div>
                        <div class="error-message" id="confirmError" style="display: none;">
                            <i class="fas fa-exclamation-circle"></i>
                            Passwords do not match
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="terms-group">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="terms" id="terms" required>
                            <span class="checkbox-label">
                                I agree to the 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a> 
                                and 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>

                    <!-- Social Login -->
                    <div class="social-login">
                        <p>Or register with</p>
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

                    <!-- Login Link -->
                    <div class="login-link">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Terms & Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Booking and Cancellation</h6>
                    <p>All bookings are subject to availability. Cancellations made within 24 hours of check-in may incur charges equal to one night's stay.</p>
                    
                    <h6>2. Payment Terms</h6>
                    <p>Full payment is required at the time of booking for online reservations. We accept all major credit cards and PayPal.</p>
                    
                    <h6>3. Hotel Policies</h6>
                    <p>Check-in time is 2:00 PM and check-out is 11:00 AM. Early check-in and late check-out are subject to availability.</p>
                    
                    <h6>4. Guest Responsibilities</h6>
                    <p>Guests are responsible for any damages to hotel property during their stay.</p>
                    
                    <h6>5. Privacy</h6>
                    <p>We respect your privacy and handle all personal information in accordance with our Privacy Policy.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Information We Collect</h6>
                    <p>We collect personal information including name, email, phone number, and payment details to process your bookings.</p>
                    
                    <h6>How We Use Your Information</h6>
                    <p>Your information is used for booking management, customer service, and marketing communications (with your consent).</p>
                    
                    <h6>Data Security</h6>
                    <p>We implement industry-standard security measures to protect your personal information from unauthorized access.</p>
                    
                    <h6>Third-Party Disclosure</h6>
                    <p>We do not sell or trade your personal information to third parties without your consent.</p>
                    
                    <h6>Your Rights</h6>
                    <p>You have the right to access, correct, or delete your personal data at any time.</p>
                </div>
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
            });

            // Password strength checker
            $('#password').on('keyup', function() {
                const password = $(this).val();
                const strength = checkPasswordStrength(password);
                
                // Update strength bar
                const strengthBar = $('#strengthBar');
                strengthBar.css('width', strength.percentage + '%');
                strengthBar.css('background-color', strength.color);
                
                // Update strength text
                $('#strengthText').text(strength.message).css('color', strength.color);
                
                // Update rules
                updateRule('lengthRule', password.length >= 8);
                updateRule('uppercaseRule', /[A-Z]/.test(password));
                updateRule('lowercaseRule', /[a-z]/.test(password));
                updateRule('numberRule', /\d/.test(password));
                updateRule('specialRule', /[!@#$%^&*(),.?":{}|<>]/.test(password));
            });

            function checkPasswordStrength(password) {
                let strength = 0;
                
                if (password.length >= 8) strength += 20;
                if (password.length >= 12) strength += 10;
                if (/[A-Z]/.test(password)) strength += 20;
                if (/[a-z]/.test(password)) strength += 20;
                if (/\d/.test(password)) strength += 15;
                if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 15;
                
                let message = '';
                let color = '';
                
                if (strength <= 30) {
                    message = 'Weak Password';
                    color = '#dc3545';
                } else if (strength <= 60) {
                    message = 'Fair Password';
                    color = '#ffc107';
                } else if (strength <= 80) {
                    message = 'Good Password';
                    color = '#17a2b8';
                } else {
                    message = 'Strong Password';
                    color = '#28a745';
                }
                
                return {
                    percentage: strength,
                    message: message,
                    color: color
                };
            }

            function updateRule(ruleId, isValid) {
                const rule = $('#' + ruleId);
                const icon = rule.find('i');
                
                if (isValid) {
                    rule.addClass('valid').removeClass('invalid');
                    icon.removeClass('fa-circle').addClass('fas fa-check-circle');
                } else {
                    rule.addClass('invalid').removeClass('valid');
                    icon.removeClass('fa-check-circle').addClass('fas fa-circle');
                }
            }

            // Confirm password matching
            $('#password_confirmation, #password').on('keyup', function() {
                const password = $('#password').val();
                const confirm = $('#password_confirmation').val();
                const confirmIcon = $('#confirmIcon');
                const confirmError = $('#confirmError');
                
                if (confirm.length > 0) {
                    if (password === confirm) {
                        $('#password_confirmation').removeClass('is-invalid').addClass('is-valid');
                        confirmIcon.removeClass('fa-times-circle text-danger').addClass('fa-check-circle text-success');
                        confirmError.hide();
                    } else {
                        $('#password_confirmation').removeClass('is-valid').addClass('is-invalid');
                        confirmIcon.removeClass('fa-check-circle text-success').addClass('fa-times-circle text-danger');
                        confirmError.show();
                    }
                } else {
                    $('#password_confirmation').removeClass('is-valid is-invalid');
                    confirmIcon.removeClass('fa-check-circle fa-times-circle text-success text-danger');
                    confirmError.hide();
                }
            });

            // Form submission with loading state
            $('#registerForm').on('submit', function(e) {
                const password = $('#password').val();
                const confirm = $('#password_confirmation').val();
                const termsChecked = $('#terms').is(':checked');
                
                if (password !== confirm) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'Passwords do not match!',
                        confirmButtonColor: '#c4a747'
                    });
                    return false;
                }
                
                if (!termsChecked) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Terms & Conditions',
                        text: 'Please accept the terms and conditions to continue.',
                        confirmButtonColor: '#c4a747'
                    });
                    return false;
                }
                
                const btn = $('#submitBtn');
                btn.html('<i class="fas fa-spinner fa-spin"></i> Creating Account...');
                btn.prop('disabled', true);
            });

            // Auto-hide error messages after 5 seconds
            setTimeout(function() {
                $('.error-message').fadeOut();
            }, 5000);
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>