# Use an appropriate base image
FROM php:7.4-fpm

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app/

# Install dependencies
RUN apt-get update && \
    apt-get install -y git zip unzip vsftpd ftp && \
    docker-php-ext-install pdo_mysql && \
    mkdir -p /var/log/nginx && \
    mkdir -p /var/cache/nginx && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --ignore-platform-reqs --no-interaction --optimize-autoloader

# Expose ports if necessary
EXPOSE 80 21 20

# Add vsftpd configuration
COPY vsftpd.conf /etc/vsftpd.conf

# Add script to set permissions and run services
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Command to run the application
CMD ["/entrypoint.sh"]
