#!/bin/bash

# Set permissions for Laravel files
chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Start FTP server
service vsftpd start

# Run Laravel setup
./setup.sh

# Start PHP-FPM
php-fpm
