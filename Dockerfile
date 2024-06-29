FROM serversideup/php:8.3-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install necessary packages and Composer
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs git zip unzip && \
    docker-php-ext-install pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Switch to www-data user
USER www-data

# Copy application files
COPY --chown=www-data:www-data . /var/www/html

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev && \
    npm install && \
    npm run build
