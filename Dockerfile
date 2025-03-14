# Use the serversideup/php:8.3-fpm-nginx base image
FROM serversideup/php:8.3-fpm-nginx

# Set environment variables
ENV PHP_OPCACHE_ENABLE=1

# Switch to root user to install packages and perform configurations
USER root

# Install Node.js and other necessary packages
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    apt-get install -y git zip unzip && \
    npm install -g npm@latest

# Switch back to the www-data user
USER www-data

# Set the working directory
WORKDIR /var/www/html

# Copy the application code
COPY --chown=www-data:www-data . /var/www/html

# Install npm dependencies and build assets
RUN npm install && npm run build

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Expose port 80
EXPOSE 80

# Command to start Nginx
CMD ["nginx", "-g", "daemon off;"]
