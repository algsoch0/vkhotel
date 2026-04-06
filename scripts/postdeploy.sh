#!/bin/bash

# Exit on error
set -e

echo "🗄️  Running post-deployment tasks..."

# Run pending migrations
echo "📊 Running database migrations..."
php artisan migrate --force --quiet

# Optionally seed the database
echo "🌱 Seeding admin user..."
php artisan db:seed --class=AdminUserSeeder --force --quiet || echo "Admin seeder skipped or already exists"

# Clear all caches to ensure fresh data
echo "🧹 Clearing all caches..."
php artisan cache:forget --all 2>/dev/null || true
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate sitemap (optional)
# php artisan sitemap:generate

echo "✅ Post-deployment tasks completed successfully!"
echo "🎉 Your application is ready to serve requests!"
