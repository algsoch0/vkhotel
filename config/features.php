<?php

return [
    /*
    |--------------------------------------------------------------------------
    | VK Hotel Application Features Configuration
    |--------------------------------------------------------------------------
    |
    | Configure advanced features for the VK Hotel application.
    |
    */

    // Payment Features
    'payments' => [
        'enabled' => env('FEATURE_PAYMENT_ENABLED', true),
        'stripe' => [
            'enabled' => !empty(env('STRIPE_SECRET_KEY')),
            'public_key' => env('STRIPE_PUBLIC_KEY'),
            'secret_key' => env('STRIPE_SECRET_KEY'),
            'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        ],
        'paypal' => [
            'enabled' => !empty(env('PAYPAL_CLIENT_ID')),
            'client_id' => env('PAYPAL_CLIENT_ID'),
            'secret' => env('PAYPAL_SECRET'),
            'mode' => env('PAYPAL_MODE', 'sandbox'),
        ],
    ],

    // Communication Features
    'notifications' => [
        'email' => [
            'enabled' => true,
            'send_confirmation' => true,
            'send_reminder' => true,
        ],
        'sms' => [
            'enabled' => env('FEATURE_SMS_ALERTS', false),
            'provider' => 'twilio',
        ],
    ],

    // Security Features
    'security' => [
        'two_factor_auth' => env('FEATURE_TWO_FACTOR_AUTH', true),
        'password_reset_hours' => 24,
        'session_timeout_minutes' => 120,
        'max_login_attempts' => 5,
        'lockout_duration_minutes' => 15,
    ],

    // API Features
    'api' => [
        'rate_limit' => env('API_RATE_LIMIT', 60),
        'rate_limit_window' => env('API_RATE_LIMIT_WINDOW', 1),
        'pagination_default' => 15,
        'pagination_max' => 100,
    ],

    // Room Management
    'rooms' => [
        'image_storage' => 's3', // local, s3
        'max_images' => 10,
        'image_sizes' => [
            'thumbnail' => '300x200',
            'medium' => '600x400',
            'large' => '1200x800',
        ],
    ],

    // Booking Features
    'bookings' => [
        'auto_confirm' => false,
        'confirmation_timeout_hours' => 24,
        'cancellation_policy' => 'free_until_24_hours',
        'refund_percentage' => 100, // by policy
        'allow_overlapping' => false,
    ],

    // Reviews & Ratings
    'reviews' => [
        'require_verified_booking' => true,
        'auto_verify' => false,
        'max_rating' => 5,
    ],

    // Analytics & Reporting
    'analytics' => [
        'enabled' => true,
        'google_analytics_id' => env('GOOGLE_ANALYTICS_ID'),
        'track_conversions' => true,
        'track_bookings' => true,
    ],

    // Error Tracking
    'sentry' => [
        'enabled' => !empty(env('SENTRY_LARAVEL_DSN')),
        'dsn' => env('SENTRY_LARAVEL_DSN'),
        'environment' => env('APP_ENV'),
    ],

    // Caching
    'cache' => [
        'ttl' => [
            'rooms' => 3600, // 1 hour
            'availability' => 300, // 5 minutes
            'reviews' => 7200, // 2 hours
        ],
    ],

    // Email Configuration
    'email' => [
        'from' => env('MAIL_FROM_ADDRESS', 'noreply@vkhotel.com'),
        'from_name' => env('MAIL_FROM_NAME', 'VK Hotel'),
        'support' => 'support@vkhotel.com',
    ],
];
