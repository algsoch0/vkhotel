#!/bin/bash
set -e

echo "🔨 Building VK Hotel Application..."

# Install Composer dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm install --production

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Generate APP_KEY if not exists
php artisan key:generate --force 2>/dev/null || true

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Build completed successfully!"
