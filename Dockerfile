# Use PHP 8.2 FPM Alpine as base image
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash curl unzip tzdata nginx supervisor \
    libpng-dev libzip-dev libxml2-dev icu-dev postgresql-dev oniguruma-dev \
    g++ make autoconf

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath ctype fileinfo mbstring pdo_mysql pdo_pgsql xml zip

# Install intl extension separately
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Set timezone
RUN cp /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel application
COPY . /var/www/html

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Optimize Laravel application
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan storage:link

# Define the correct WEB DOCUMENT ROOT
ENV WEB_DOCUMENT_ROOT=/var/www/html/public

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]