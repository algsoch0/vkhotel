#!/bin/bash
set -e

echo "🚀 Starting VK Hotel Application..."

# Run database migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Seed database if needed (optional - comment out if not needed)
# php artisan db:seed --class=AdminUserSeeder --force

# Cache configuration and routes for better performance
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP server
echo "✅ Application started! Listening on port 8080"
php -S 0.0.0.0:${PORT:-8080} -t public/
