# Use an appropriate base image
FROM serversideup/php:8.3-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY --chown=www-data:www-data . /var/www/html

# Copy Nginx configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY mime.types /etc/nginx/mime.types

# Switch to www-data user
USER www-data

# Install NPM dependencies and build assets
RUN npm install && npm run build

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev


# Obtain SSL certificates using Certbot
RUN certbot certonly --standalone -d api-server.197.253.124.146.sslip.io --non-interactive --agree-tos --email your-email@example.com


# Expose ports for HTTP and HTTPS
EXPOSE 80 443

# Start the service
CMD ["supervisord", "-n"]



