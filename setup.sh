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

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Laravel setup completed successfully."
