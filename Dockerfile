# Dockerfile

FROM serversideup/php:8.3-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# Copy Nginx mime.types
RUN mkdir -p /etc/nginx/
RUN cp /etc/nginx/mime.types /etc/nginx/
# Copy Nginx configuration files
RUN mkdir -p /etc/nginx/snippets/
RUN cp /etc/nginx/snippets/fastcgi-php.conf /etc/nginx/snippets/

COPY --chown=www-data:www-data . /var/www/html

USER www-data

RUN npm install
RUN npm run build

RUN composer install --no-interaction --optimize-autoloader --no-dev
