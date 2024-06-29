# Stage 1: Build
FROM node:16-alpine as build

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run production

# Stage 2: Production
FROM php:7.4-fpm

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app/

# Install dependencies
RUN apt-get update && \
    apt-get install -y git zip unzip nginx certbot && \
    docker-php-ext-install pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --ignore-platform-reqs --no-interaction --optimize-autoloader

# Obtain SSL certificates using Certbot
RUN certbot certonly --standalone -d api-server.197.253.124.146.sslip.io --non-interactive --agree-tos --email your-email@example.com

# Copy the built assets from Stage 1
COPY --from=build /app/public /app/public

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Expose port if necessary
EXPOSE 443

# Start Nginx and PHP-FPM
CMD service nginx start && php-fpm
