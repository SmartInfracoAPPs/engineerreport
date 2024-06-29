#!/bin/bash

# Exit on error
set -e

# Ensure the script is being run from the project's root directory
if [ ! -f "artisan" ]; then
  echo "This script must be run from the Laravel project's root directory."
  exit 1
fi

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev

# Install NPM dependencies
echo "Installing NPM dependencies..."
npm install

# Build assets
echo "Building assets..."
npm run production

# Check if the migration table exists and rollback migrations
if php artisan migrate:status >/dev/null 2>&1; then
  echo "Rolling back previous migrations..."
  php artisan migrate:rollback --force
fi

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Cache the configuration
echo "Caching configuration..."
php artisan config:cache

# Cache the routes
echo "Caching routes..."
php artisan route:cache

# Cache the views
echo "Caching views..."
php artisan view:cache

# Create storage symbolic link
echo "Creating storage symbolic link..."
php artisan storage:link

echo "Laravel setup completed successfully."
