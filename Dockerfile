# Use official PHP 8.2 Alpine image
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    unzip \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    oniguruma-dev \
    postgresql-dev \
    icu-dev \
    tzdata

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath \
    ctype \
    fileinfo \
    json \
    mbstring \
    pdo_mysql \
    pdo_pgsql \
    tokenizer \
    xml \
    zip

# Install and enable Redis extension (optional)
RUN pecl install redis && docker-php-ext-enable redis

# Set timezone
RUN cp /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Config Laravel Application
ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production
WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache
# Create Symlink
RUN php artisan storage:link

# Expose port (PHP-FPM listens on this port)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]