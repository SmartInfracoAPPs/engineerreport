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
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --ignore-platform-reqs --no-interaction --optimize-autoloader

# Expose PHP-FPM port
EXPOSE 9000

# Command to run PHP-FPM
CMD ["php-fpm"]
