# Base image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    vim \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files and set ownership
COPY --chown=www-data:www-data . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose Laravel dev server port
EXPOSE 8000

# Run Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]