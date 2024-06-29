# Use an appropriate base image
FROM php:7.4-fpm

# Install Nginx
RUN apt-get update && \
    apt-get install -y nginx

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app/

# Copy Nginx configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY nginx_ssl.conf /etc/nginx/conf.d/nginx_ssl.conf

# Install dependencies
RUN apt-get update && \
    apt-get install -y git zip unzip && \
    docker-php-ext-install pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --ignore-platform-reqs --no-interaction --optimize-autoloader

# Obtain SSL certificates using Certbot
RUN certbot certonly --standalone -d api-server.197.253.124.146.sslip.io --non-interactive --agree-tos --email your-email@example.com


# Expose port if necessary
EXPOSE 80 443

# Command to run the application
CMD ["nginx", "-g", "daemon off;"]
