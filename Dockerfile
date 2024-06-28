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

# Install Nginx
RUN apt-get install -y nginx

# Remove default server definition
RUN rm /etc/nginx/sites-enabled/default

# Add custom server definition
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose ports
EXPOSE 80
EXPOSE 443

# Command to run the application
CMD service nginx start && php-fpm
