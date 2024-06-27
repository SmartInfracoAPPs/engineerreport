# Use an appropriate base image
FROM php:7.4-fpm

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app/

# Install dependencies
RUN apt-get update && \
    apt-get install -y git zip unzip && \
    docker-php-ext-install pdo_mysql && \
    mkdir -p /var/log/nginx && \
    mkdir -p /var/cache/nginx && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --ignore-platform-reqs --no-interaction --optimize-autoloader

# Expose port if necessary
# EXPOSE 8000

# Command to run the application
# CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Adjust CMD as per your application's requirements